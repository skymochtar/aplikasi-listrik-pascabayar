<?php
$page_title = "Dashboard Admin";
// Panggil config dan header
require_once '../config/database.php';
require_once '../templates/header.php';

// Proteksi Halaman
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama']); ?>!</h1>
<p>Anda telah berhasil login sebagai **Admin**.</p>

<h3>Menu Navigasi</h3>
<nav>
    <ul>
        <li><a href="kelola_pelanggan.php">Kelola Pelanggan</a></li>
        <li><a href="input_penggunaan.php">Input Penggunaan</a></li>
        <li><a href="kelola_tarif.php">Kelola Tarif</a></li>
        <li><a href="kelola_tagihan.php">Kelola Tagihan</a></li>
    </ul>
</nav>

<br>
<a href="../auth/logout.php">Logout</a>

<?php
// Panggil footer
require_once '../templates/footer.php';
?>