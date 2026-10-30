<?php
require 'config.php';
if (!empty($_SESSION['user'])) { header('Location: index.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = t('fill_all');
    } else {
        $st = mysqli_prepare($conn, "SELECT password FROM users WHERE username = ?");
        mysqli_stmt_bind_param($st, 's', $username);
        mysqli_stmt_execute($st);
        $row = mysqli_stmt_get_result($st)->fetch_assoc();

        if ($row && password_verify($password, $row['password'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = $username;
            header('Location: index.php'); exit;
        } else {
            $error = t('login_failed');
        }
    }
}
include 'header.php';
?>
<h2><?= e(t('login')) ?></h2>
<?php if ($error): ?><div class="err"><?= e($error) ?></div><?php endif; ?>
<form method="POST">
  <label><?= e(t('username')) ?></label>
  <input type="text" name="username" value="<?= e($_POST['username'] ?? '') ?>">
  <label><?= e(t('password')) ?></label>
  <input type="password" name="password">
  <button class="btn" type="submit"><?= e(t('login')) ?></button>
</form>
<?php include 'footer.php'; ?>
