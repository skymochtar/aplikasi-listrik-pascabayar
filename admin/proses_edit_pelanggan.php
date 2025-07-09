<?php
require_once '../config/database.php';

// Proteksi & Verifikasi Form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') {
    
    // Ambil semua data dari form
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $username = $_POST['username'];
    $nomor_kwh = $_POST['nomor_kwh'];
    $alamat = $_POST['alamat'];
    $id_tarif = $_POST['id_tarif'];
    
    // Buat query UPDATE
    $sql = "UPDATE pelanggan SET 
                nama_pelanggan = '$nama_pelanggan',
                username = '$username',
                nomor_kwh = '$nomor_kwh',
                alamat = '$alamat',
                id_tarif = '$id_tarif'
            WHERE id_pelanggan = $id_pelanggan";

    // Eksekusi query
    if (mysqli_query($conn, $sql)) {
        header("Location: kelola_pelanggan.php?status=edit_sukses");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
} else {
    header("Location: ../auth/login.php");
}
?>