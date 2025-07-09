<?php
$page_title = "Kelola Pelanggan";
// Panggil config DULU untuk session_start() dan koneksi $conn
require_once '../config/database.php'; 
require_once '../templates/header.php';

// Proteksi Halaman
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// ---- LOGIKA PAGINASI ----
// 1. Tentukan batas data per halaman
$limit = 5;

// 2. Ambil nomor halaman saat ini dari URL, jika tidak ada maka default ke halaman 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); // Pastikan halaman tidak kurang dari 1

// 3. Hitung total data pelanggan
$total_result = mysqli_query($conn, "SELECT count(*) AS total FROM pelanggan");
$total_rows = mysqli_fetch_assoc($total_result)['total'];
$total_pages = ceil($total_rows / $limit);

// 4. Hitung offset (data mulai dari mana)
$offset = ($page - 1) * $limit;
// ---- AKHIR LOGIKA PAGINASI ----


// Query untuk mengambil data pelanggan DENGAN BATAS (LIMIT)
$sql = "SELECT p.*, t.daya 
        FROM pelanggan p 
        JOIN tarif t ON p.id_tarif = t.id_tarif 
        ORDER BY p.nama_pelanggan ASC
        LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $sql);
?>

<h1>Kelola Data Pelanggan</h1>
<a href="index.php" class="btn">Kembali ke Dashboard</a>
<a href="tambah_pelanggan.php" class="btn" style="margin-left: 10px;">+ Tambah Pelanggan Baru</a>
<br><br>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Nomor KWH</th>
            <th>Daya (VA)</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php $no = $offset + 1; ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                    <td><?php echo htmlspecialchars($row['nomor_kwh']); ?></td>
                    <td><?php echo htmlspecialchars($row['daya']); ?> VA</td>
                    <td>
                        <a href="edit_pelanggan.php?id=<?php echo $row['id_pelanggan']; ?>">Edit</a> |
                        <a href="hapus_pelanggan.php?id=<?php echo $row['id_pelanggan']; ?>" onclick="return confirm('Anda yakin?');">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;">Belum ada data pelanggan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="kelola_pelanggan.php?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>
</div>
<?php
require_once '../templates/footer.php';
?>