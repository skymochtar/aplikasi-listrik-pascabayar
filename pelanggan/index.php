<?php
$page_title = "Dashboard Pelanggan";
require_once '../config/database.php';
require_once '../templates/header.php';

// Proteksi Halaman
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'pelanggan') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama']); ?>!</h1>
<p>Ini adalah halaman dashboard Anda.</p>
    
<nav>
    <ul>
        <li><a href="lihat_tagihan.php">Lihat Tagihan</a></li>
        <li><a href="profil.php">Profil Saya</a></li>
    </ul>
</nav>
    
<br>
<a href="../auth/logout.php">Logout</a>

<?php
require_once '../templates/footer.php';
?>