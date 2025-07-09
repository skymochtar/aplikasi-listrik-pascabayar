<?php
require_once '../config/database.php';

// Proteksi Halaman dan Verifikasi Form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') {
    
    // Ambil data dari form
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Ingat untuk hashing di aplikasi production
    $nomor_kwh = $_POST['nomor_kwh'];
    $alamat = $_POST['alamat'];
    $id_tarif = $_POST['id_tarif'];
    
    // Buat query INSERT
    $sql = "INSERT INTO pelanggan (nama_pelanggan, username, password, nomor_kwh, alamat, id_tarif) 
            VALUES ('$nama_pelanggan', '$username', '$password', '$nomor_kwh', '$alamat', '$id_tarif')";

    // Eksekusi query
    if (mysqli_query($conn, $sql)) {
        // Jika berhasil, kembali ke halaman kelola pelanggan
        header("Location: kelola_pelanggan.php?status=sukses");
    } else {
        // Jika gagal, tampilkan error
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
} else {
    // Jika diakses tanpa izin, tendang ke login
    header("Location: ../auth/login.php");
}
?>