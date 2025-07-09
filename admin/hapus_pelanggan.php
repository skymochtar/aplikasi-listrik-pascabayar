<?php
require_once '../config/database.php';

// Proteksi & Cek ID
if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin' && isset($_GET['id'])) {
    
    $id_pelanggan = $_GET['id'];
    
    // Query DELETE
    $sql = "DELETE FROM pelanggan WHERE id_pelanggan = $id_pelanggan";
    
    if (mysqli_query($conn, $sql)) {
        // Kembali ke halaman kelola pelanggan jika berhasil
        header("Location: kelola_pelanggan.php?status=hapus_sukses");
    } else {
        // Tampilkan error jika gagal
        echo "Error: " . mysqli_error($conn);
    }

} else {
    // Tendang jika diakses secara ilegal
    header("Location: ../auth/login.php");
}
?>