<?php
// 1. Meng-include file koneksi database
require_once '../config/database.php';

// 2. Memastikan form disubmit dengan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 3. Mengambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 4. Membuat query untuk mencari user di tabel 'pelanggan'
    $sql_pelanggan = "SELECT * FROM pelanggan WHERE username = '$username' AND password = '$password'";
    $result_pelanggan = mysqli_query($conn, $sql_pelanggan);

    // 5. Membuat query untuk mencari user di tabel 'user' (admin)
    $sql_admin = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result_admin = mysqli_query($conn, $sql_admin);

    // 6. Logika Pengecekan
    if (mysqli_num_rows($result_pelanggan) > 0) {
        // Jika ditemukan sebagai pelanggan
        $user = mysqli_fetch_assoc($result_pelanggan);
        $_SESSION['user_id'] = $user['id_pelanggan'];
        $_SESSION['nama'] = $user['nama_pelanggan'];
        $_SESSION['role'] = 'pelanggan';
        header("Location: ../pelanggan/index.php"); // Arahkan ke dashboard pelanggan
        exit();

    } elseif (mysqli_num_rows($result_admin) > 0) {
        // Jika ditemukan sebagai admin
        $user = mysqli_fetch_assoc($result_admin);
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['nama'] = $user['nama_admin'];
        $_SESSION['role'] = 'admin';
        header("Location: ../admin/index.php"); // Arahkan ke dashboard admin
        exit();

    } else {
        // Jika tidak ditemukan di kedua tabel
        echo "<script>
                alert('Username atau password salah!');
                window.location.href = 'login.php';
              </script>";
        exit();
    }
}
?>