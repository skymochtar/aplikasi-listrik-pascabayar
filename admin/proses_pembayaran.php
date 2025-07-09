<?php
require_once '../config/database.php';

// Proteksi & Cek ID
if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin' && isset($_GET['id_tagihan'])) {
    
    $id_tagihan = $_GET['id_tagihan'];
    $id_admin = $_SESSION['user_id'];
    $tanggal_bayar = date("Y-m-d H:i:s");

    // Ambil data dari tagihan untuk dimasukkan ke tabel pembayaran
    $tagihan_res = mysqli_query($conn, "SELECT * FROM tagihan WHERE id_tagihan = $id_tagihan");
    $tagihan = mysqli_fetch_assoc($tagihan_res);
    $id_pelanggan = $tagihan['id_pelanggan'];

    // ===== BAGIAN PENTING YANG BARU =====
    // Panggil fungsi SQL untuk mendapatkan total bayar yang sebenarnya
    $total_bayar_res = mysqli_query($conn, "SELECT hitung_total_tagihan($id_tagihan) AS total");
    $total_bayar_row = mysqli_fetch_assoc($total_bayar_res);
    $total_bayar = $total_bayar_row['total'];
    // ===================================

    // 1. Update status di tabel tagihan ke "Lunas"
    $update_sql = "UPDATE tagihan SET status = 'Lunas' WHERE id_tagihan = $id_tagihan";
    
    if (mysqli_query($conn, $update_sql)) {
        // 2. Insert record ke tabel pembayaran dengan total bayar yang sudah dihitung
        $insert_sql = "INSERT INTO pembayaran (id_tagihan, id_pelanggan, tanggal_pembayaran, biaya_admin, total_bayar, id_user)
                       VALUES ('$id_tagihan', '$id_pelanggan', '$tanggal_bayar', 2500, '$total_bayar', '$id_admin')";
        mysqli_query($conn, $insert_sql);

        header("Location: kelola_tagihan.php?status=bayar_sukses");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} else {
    header("Location: ../auth/login.php");
}
?>