<?php
require 'config.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0) {
        $st = mysqli_prepare($conn, "DELETE FROM mahasiswa WHERE id = ?");
        mysqli_stmt_bind_param($st, 'i', $id);
        mysqli_stmt_execute($st);
        $_SESSION['flash'] = 'msg_deleted';
    }
}
header('Location: index.php');
exit;
