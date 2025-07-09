<?php
$page_title = "Kelola Tarif";
require_once '../config/database.php';
require_once '../templates/header.php';

// Proteksi Halaman
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$tariffs = mysqli_query($conn, "SELECT * FROM tarif ORDER BY daya ASC");
?>

<h1>Kelola Data Tarif</h1>
<a href="index.php" class="btn">Kembali ke Dashboard</a>
<a href="tambah_tarif.php" class="btn" style="margin-left: 10px;">+ Tambah Tarif Baru</a>
<br><br>

<table>
    <thead>
        <tr>
            <th>Daya (VA)</th>
            <th>Tarif per KWH</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($tariffs) > 0): ?>
            <?php while($tarif = mysqli_fetch_assoc($tariffs)): ?>
            <tr>
                <td><?php echo number_format($tarif['daya']); ?> VA</td>
                <td>Rp <?php echo number_format($tarif['tarifperkwh'], 2, ',', '.'); ?></td>
                <td>
                    <a href="edit_tarif.php?id=<?php echo $tarif['id_tarif']; ?>">Edit</a> |
                    <a href="hapus_tarif.php?id=<?php echo $tarif['id_tarif']; ?>" onclick="return confirm('Anda yakin ingin menghapus tarif ini?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="3" style="text-align:center;">Belum ada data tarif.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
require_once '../templates/footer.php';
?>