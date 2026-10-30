<?php
session_start();
$lang = $_SESSION['lang'] ?? 'id';
$_SESSION = ['lang' => $lang];   // hapus data login, pertahankan bahasa
session_regenerate_id(true);
header('Location: login.php');
exit;
