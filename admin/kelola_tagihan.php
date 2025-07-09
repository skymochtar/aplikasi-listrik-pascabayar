<?php
$page_title = "Kelola Tagihan";
require_once '../config/database.php';
require_once '../templates/header.php';

// Proteksi Halaman
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$sql = "SELECT t.*, pl.nama_pelanggan, pl.nomor_kwh
        FROM tagihan t
        JOIN pelanggan pl ON t.id_pelanggan = pl.id_pelanggan
        ORDER BY t.tahun DESC, t.bulan DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="page-header">
    <h1>Kelola Seluruh Tagihan</h1>
    <a href="index.php" class="btn">Kembali ke Dashboard</a>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Nomor KWH</th>
            <th>Periode</th>
            <th>Total Penggunaan (KWH)</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php $no = 1; ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                    <td><?php echo htmlspecialchars($row['nomor_kwh']); ?></td>
                    <td><?php echo $row['bulan'] . ' ' . $row['tahun']; ?></td>
                    <td><?php echo htmlspecialchars($row['jumlah_meter']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <?php if ($row['status'] == 'Belum Dibayar'): ?>
                            <a href="proses_pembayaran.php?id_tagihan=<?php echo $row['id_tagihan']; ?>" onclick="return confirm('Konfirmasi pembayaran?');">
                                Konfirmasi Pembayaran
                            </a>
                        <?php else: ?>
                            Lunas
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align:center;">Belum ada data tagihan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
require_once '../templates/footer.php';
?>