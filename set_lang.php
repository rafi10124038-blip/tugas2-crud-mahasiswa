<?php
session_start();
$l = $_GET['lang'] ?? 'id';
switch ($l) {
    case 'en': $_SESSION['lang'] = 'en'; break;
    default:   $_SESSION['lang'] = 'id';
}
$back = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $back");
exit;
