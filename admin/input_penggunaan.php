<?php
$page_title = "Input Penggunaan";
require_once '../config/database.php';
require_once '../templates/header.php';

// Proteksi Halaman
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Ambil semua data pelanggan untuk dropdown
$pelanggan_list = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY nama_pelanggan");
?>

<h1>Input Penggunaan Listrik Pelanggan</h1>
<a href="index.php" class="btn">Kembali ke Dashboard</a>
<br><br>

<form action="proses_input_penggunaan.php" method="POST">
    <p>
        <label>Pilih Pelanggan:</label>
        <select name="id_pelanggan" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php while($pelanggan = mysqli_fetch_assoc($pelanggan_list)): ?>
                <option value="<?php echo $pelanggan['id_pelanggan']; ?>">
                    <?php echo htmlspecialchars($pelanggan['nomor_kwh'] . ' - ' . $pelanggan['nama_pelanggan']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </p>
    <p>
        <label>Bulan:</label>
        <input type="number" name="bulan" min="1" max="12" required>
    </p>
    <p>
        <label>Tahun:</label>
        <input type="number" name="tahun" min="2020" required>
    </p>
    <p>
        <label>Meter Awal (KWH):</label>
        <input type="number" step="0.01" name="meter_awal" required>
    </p>
    <p>
        <label>Meter Akhir (KWH):</label>
        <input type="number" step="0.01" name="meter_akhir" required>
    </p>
    <p>
        <button type="submit">Simpan Penggunaan</button>
    </p>
</form>

<?php
require_once '../templates/footer.php';
?>