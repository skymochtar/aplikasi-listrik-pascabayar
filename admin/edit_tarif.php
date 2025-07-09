<?php
$page_title = "Edit Tarif";
require_once '../config/database.php';
require_once '../templates/header.php';

// Proteksi Halaman & Cek ID
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin' || !isset($_GET['id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$id_tarif = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM tarif WHERE id_tarif = $id_tarif");
$tarif = mysqli_fetch_assoc($result);

if (!$tarif) {
    header("Location: kelola_tarif.php");
    exit();
}
?>

<h1>Form Edit Tarif</h1>
<a href="kelola_tarif.php" class="btn">Kembali ke Daftar Tarif</a>
<br><br>

<form action="proses_edit_tarif.php" method="POST">
    <input type="hidden" name="id_tarif" value="<?php echo $tarif['id_tarif']; ?>">

    <p>
        <label>Daya (VA):</label><br>
        <input type="number" name="daya" value="<?php echo htmlspecialchars($tarif['daya']); ?>" required>
    </p>
    <p>
        <label>Tarif per KWH (Rp):</label><br>
        <input type="number" step="0.01" name="tarifperkwh" value="<?php echo htmlspecialchars($tarif['tarifperkwh']); ?>" required>
    </p>
    <p>
        <button type="submit">Update Tarif</button>
    </p>
</form>

<?php
require_once '../templates/footer.php';
?>