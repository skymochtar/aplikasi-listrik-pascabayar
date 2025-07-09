<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ambil semua data dari form
    $nama_pelanggan = mysqli_real_escape_string($conn, $_POST['nama_pelanggan']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Sebaiknya di-hash
    $nomor_kwh = mysqli_real_escape_string($conn, $_POST['nomor_kwh']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $id_tarif = (int)$_POST['id_tarif'];

    // Cek duplikasi username atau nomor kwh
    $check_sql = "SELECT * FROM pelanggan WHERE username = '$username' OR nomor_kwh = '$nomor_kwh'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Username atau Nomor KWH sudah terdaftar!');
                window.history.back();
              </script>";
        exit();
    }
    
    // Query INSERT data baru
    $sql = "INSERT INTO pelanggan (nama_pelanggan, username, password, nomor_kwh, alamat, id_tarif) 
            VALUES ('$nama_pelanggan', '$username', '$password', '$nomor_kwh', '$alamat', '$id_tarif')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Registrasi berhasil! Silakan login.');
                window.location.href = 'login.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
} else {
    header("Location: register.php");
}
?>