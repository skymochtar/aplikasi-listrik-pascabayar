<?php
require_once '../config/database.php';

// Proteksi halaman dan pastikan ID ada di URL
if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin' && isset($_GET['id'])) {

    $id_tarif = $_GET['id'];

    // Buat query DELETE
    $sql = "DELETE FROM tarif WHERE id_tarif = $id_tarif";

    // Eksekusi query
    if (mysqli_query($conn, $sql)) {
        // Jika berhasil, kembali ke halaman kelola tarif
        header("Location: kelola_tarif.php?status=hapus_sukses");
    } else {
        // Jika gagal, tampilkan pesan error
        // Error ini bisa terjadi jika tarif masih digunakan oleh pelanggan
        echo "Error: " . mysqli_error($conn);
    }

} else {
    // Jika diakses secara ilegal, arahkan ke halaman login
    header("Location: ../auth/login.php");
}
?>