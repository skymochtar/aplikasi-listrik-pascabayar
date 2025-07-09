<?php
// --- TAMBAHKAN KODE INI UNTUK MENAMPILKAN ERROR ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// ---------------------------------------------

define('BASE_URL', '/listrik-pascabayar');
// ... sisa kode ...

// Konfigurasi untuk koneksi ke database
$host = "localhost";
$user = "root";
$pass = ""; // Default password Laragon kosong
$db_name = "db_listrik_pascabayar";

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db_name);

// Cek jika koneksi gagal
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Memulai session untuk menyimpan data login pengguna
session_start();
?>