<?php
require 'config.php';
require_login();

$majors = ['Teknik Informatika', 'Sistem Informasi', 'Teknik Elektro', 'Manajemen'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$data = ['nim' => '', 'nama' => '', 'jurusan' => '', 'email' => ''];
$errors = [];

// Mode Update: ambil data lama
if ($id > 0) {
    $st = mysqli_prepare($conn, "SELECT nim, nama, jurusan, email FROM mahasiswa WHERE id = ?");
    mysqli_stmt_bind_param($st, 'i', $id);
    mysqli_stmt_execute($st);
    $row = mysqli_stmt_get_result($st)->fetch_assoc();
    if (!$row) { header('Location: index.php'); exit; }
    $data = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitasi input
    $data['nim']     = trim(filter_var($_POST['nim'] ?? '', FILTER_SANITIZE_NUMBER_INT));
    $data['nama']    = trim(strip_tags($_POST['nama'] ?? ''));
    $data['jurusan'] = trim($_POST['jurusan'] ?? '');
    $data['email']   = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));

    // Validasi (if-else & switch)
    if ($data['nim'] === '' || !ctype_digit($data['nim'])) {
        $errors[] = t('err_nim');
    }
    if ($data['nama'] === '') {
        $errors[] = t('err_name');
    }
    switch (true) {
        case in_array($data['jurusan'], $majors, true):
            break;
        default:
            $errors[] = t('err_major');
    }
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = t('err_email');
    }

    // Cek NIM duplikat
    if (!$errors) {
        $st = mysqli_prepare($conn, "SELECT id FROM mahasiswa WHERE nim = ? AND id <> ?");
        mysqli_stmt_bind_param($st, 'si', $data['nim'], $id);
        mysqli_stmt_execute($st);
        if (mysqli_stmt_get_result($st)->num_rows > 0) { $errors[] = t('err_dup'); }
    }

    if (!$errors) {
        if ($id > 0) {   // UPDATE
            $st = mysqli_prepare($conn, "UPDATE mahasiswa SET nim=?, nama=?, jurusan=?, email=? WHERE id=?");
            mysqli_stmt_bind_param($st, 'ssssi', $data['nim'], $data['nama'], $data['jurusan'], $data['email'], $id);
            $_SESSION['flash'] = 'msg_updated';
        } else {         // CREATE
            $st = mysqli_prepare($conn, "INSERT INTO mahasiswa (nim, nama, jurusan, email) VALUES (?,?,?,?)");
            mysqli_stmt_bind_param($st, 'ssss', $data['nim'], $data['nama'], $data['jurusan'], $data['email']);
            $_SESSION['flash'] = 'msg_saved';
        }
        mysqli_stmt_execute($st);
        header('Location: index.php'); exit;
    }
}
include 'header.php';
?>
<h2><?= e($id > 0 ? t('form_edit') : t('form_add')) ?></h2>
<?php foreach ($errors as $er): ?><div class="err"><?= e($er) ?></div><?php endforeach; ?>
<form method="POST">
  <label><?= e(t('nim')) ?></label>
  <input type="text" name="nim" value="<?= e($data['nim']) ?>">
  <label><?= e(t('name')) ?></label>
  <input type="text" name="nama" value="<?= e($data['nama']) ?>">
  <label><?= e(t('major')) ?></label>
  <select name="jurusan">
    <option value=""><?= e(t('choose')) ?></option>
    <?php foreach ($majors as $m): ?>
      <option value="<?= e($m) ?>" <?= $data['jurusan'] === $m ? 'selected' : '' ?>><?= e($m) ?></option>
    <?php endforeach; ?>
  </select>
  <label><?= e(t('email')) ?></label>
  <input type="text" name="email" value="<?= e($data['email']) ?>">
  <button class="btn" type="submit"><?= e(t('save')) ?></button>
  <a class="btn gray" href="index.php"><?= e(t('cancel')) ?></a>
</form>
<?php include 'footer.php'; ?>
