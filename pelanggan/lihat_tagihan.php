<?php
$page_title = "Riwayat Tagihan";
require_once '../config/database.php';
require_once '../templates/header.php';

// Proteksi Halaman
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'pelanggan') {
    header("Location: ../auth/login.php");
    exit();
}

$id_pelanggan = $_SESSION['user_id'];

// Query untuk mengambil data tagihan
$sql = "SELECT t.*, p.meter_awal, p.meter_akhir, hitung_total_tagihan(t.id_tagihan) AS total_tagihan
        FROM tagihan t
        JOIN penggunaan p ON t.id_penggunaan = p.id_penggunaan
        WHERE t.id_pelanggan = $id_pelanggan
        ORDER BY t.tahun DESC, t.bulan DESC";
$result = mysqli_query($conn, $sql);
?>

<h1>Riwayat Tagihan Listrik Anda</h1>
<a href="index.php" class="btn">Kembali ke Dashboard</a>
<br><br>

<table>
    <thead>
        <tr>
            <th>Periode</th>
            <th>Meter Awal</th>
            <th>Meter Akhir</th>
            <th>Penggunaan (KWH)</th>
            <th>Total Tagihan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['bulan'] . ' ' . $row['tahun']; ?></td>
                    <td><?php echo htmlspecialchars($row['meter_awal']); ?></td>
                    <td><?php echo htmlspecialchars($row['meter_akhir']); ?></td>
                    <td><?php echo htmlspecialchars($row['jumlah_meter']); ?></td>
                    <td>Rp <?php echo number_format($row['total_tagihan'], 2, ',', '.'); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">Anda belum memiliki tagihan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
require_once '../templates/footer.php';
?>