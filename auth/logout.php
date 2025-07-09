<?php
// Memulai session
session_start();

// Menghapus semua data session
session_destroy();

// Mengarahkan pengguna kembali ke halaman login
header("Location: login.php");
exit();
?>