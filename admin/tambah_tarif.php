<?php
$page_title = "Tambah Tarif";
require_once '../config/database.php';
require_once '../templates/header.php';

// Proteksi Halaman
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<h1>Form Tambah Tarif Baru</h1>
<a href="kelola_tarif.php" class="btn">Kembali ke Daftar Tarif</a>
<br><br>

<form action="proses_tambah_tarif.php" method="POST">
    <p>
        <label>Daya (VA):</label><br>
        <input type="number" name="daya" required>
    </p>
    <p>
        <label>Tarif per KWH (Rp):</label><br>
        <input type="number" step="0.01" name="tarifperkwh" required>
    </p>
    <p>
        <button type="submit">Simpan Tarif</button>
    </p>
</form>

<?php
require_once '../templates/footer.php';
?>