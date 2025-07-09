<?php
$page_title = "Profil Saya";
require_once '../config/database.php';
require_once '../templates/header.php';

// Proteksi Halaman
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'pelanggan') {
    header("Location: ../auth/login.php");
    exit();
}

$id_pelanggan = $_SESSION['user_id'];

// Ambil data pelanggan dari database
$result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = $id_pelanggan");
$pelanggan = mysqli_fetch_assoc($result);
?>

<h1>Profil Saya</h1>
<a href="index.php" class="btn">Kembali ke Dashboard</a>
<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Nama Lengkap</th>
        <td><?php echo htmlspecialchars($pelanggan['nama_pelanggan']); ?></td>
    </tr>
    <tr>
        <th>Username</th>
        <td><?php echo htmlspecialchars($pelanggan['username']); ?></td>
    </tr>
    <tr>
        <th>Nomor KWH</th>
        <td><?php echo htmlspecialchars($pelanggan['nomor_kwh']); ?></td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td><?php echo htmlspecialchars($pelanggan['alamat']); ?></td>
    </tr>
</table>

<br>
<h3>Ubah Password</h3>
<p>Fitur ubah password akan dikembangkan selanjutnya.</p>

<?php
require_once '../templates/footer.php';
?>