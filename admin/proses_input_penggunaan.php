<?php
require_once '../config/database.php';

// Proteksi & Verifikasi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') {
    
    // Ambil data dari form
    $id_pelanggan = $_POST['id_pelanggan'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $meter_awal = $_POST['meter_awal'];
    $meter_akhir = $_POST['meter_akhir'];
    
    // Query INSERT ke tabel penggunaan
    $sql = "INSERT INTO penggunaan (id_pelanggan, bulan, tahun, meter_awal, meter_akhir) 
            VALUES ('$id_pelanggan', '$bulan', '$tahun', '$meter_awal', '$meter_akhir')";

    if (mysqli_query($conn, $sql)) {
        // Jika berhasil, trigger akan otomatis membuat tagihan
        echo "<script>
                alert('Data penggunaan berhasil disimpan dan tagihan telah dibuat!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
} else {
    header("Location: ../auth/login.php");
}
?>