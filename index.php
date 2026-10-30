<?php
require 'config.php';
require_login();

$msg = $_SESSION['flash'] ?? '';
unset($_SESSION['flash']);

$result = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY id DESC");
include 'header.php';
?>
<?php if ($msg): ?><div class="ok"><?= e(t($msg)) ?></div><?php endif; ?>
<a class="btn" href="form.php">+ <?= e(t('add')) ?></a>
<table>
 <tr><th><?= e(t('no')) ?></th><th><?= e(t('nim')) ?></th><th><?= e(t('name')) ?></th>
     <th><?= e(t('major')) ?></th><th><?= e(t('email')) ?></th><th><?= e(t('action')) ?></th></tr>
 <?php if (mysqli_num_rows($result) === 0): ?>
  <tr><td colspan="6"><?= e(t('no_data')) ?></td></tr>
 <?php endif; $no = 1; while ($r = mysqli_fetch_assoc($result)): ?>
  <tr>
   <td><?= $no++ ?></td>
   <td><?= e($r['nim']) ?></td>
   <td><?= e($r['nama']) ?></td>
   <td><?= e($r['jurusan']) ?></td>
   <td><?= e($r['email']) ?></td>
   <td>
    <a class="btn gray" href="form.php?id=<?= (int)$r['id'] ?>"><?= e(t('edit')) ?></a>
    <form class="inline" method="POST" action="delete.php" onsubmit="return confirm('<?= e(t('confirm_delete')) ?>')">
      <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
      <button class="btn red" type="submit"><?= e(t('delete')) ?></button>
    </form>
   </td>
  </tr>
 <?php endwhile; ?>
</table>
<?php include 'footer.php'; ?>
