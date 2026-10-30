<?php
session_start();

// Koneksi database (default Laragon: user root, password kosong)
$conn = mysqli_connect('localhost', 'root', '', 'db_mahasiswa');
if (!$conn) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
mysqli_set_charset($conn, 'utf8mb4');

// Bahasa disimpan di $_SESSION
$lang = $_SESSION['lang'] ?? 'id';
$L = require __DIR__ . "/lang/$lang.php";

function t($key) { global $L; return $L[$key] ?? $key; }
function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function require_login() {
    if (empty($_SESSION['user'])) { header('Location: login.php'); exit; }
}
