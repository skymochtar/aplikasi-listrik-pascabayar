<?php
$page_title = "Tambah Pelanggan";
require_once '../config/database.php';
require_once '../templates/header.php';

// Proteksi Halaman
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Ambil data tarif untuk dropdown
$tariffs = mysqli_query($conn, "SELECT * FROM tarif");
?>

<h1>Form Tambah Pelanggan</h1>
<a href="kelola_pelanggan.php" class="btn">Kembali ke Daftar Pelanggan</a>
<br><br>

<form action="proses_tambah_pelanggan.php" method="POST">
    <p>
        <label>Nama Pelanggan:</label>
        <input type="text" name="nama_pelanggan" required>
    </p>
    <p>
        <label>Username:</label>
        <input type="text" name="username" required>
    </p>
    <p>
        <label>Password:</label>
        <input type="password" name="password" required>
    </p>
    <p>
        <label>Nomor KWH:</label>
        <input type="text" name="nomor_kwh" required>
    </p>
    <p>
        <label>Alamat:</label>
        <textarea name="alamat" required></textarea>
    </p>
    <p>
        <label>Tarif Listrik:</label>
        <select name="id_tarif" required>
            <option value="">-- Pilih Tarif --</option>
            <?php while($tarif = mysqli_fetch_assoc($tariffs)): ?>
                <option value="<?php echo $tarif['id_tarif']; ?>">
                    <?php echo $tarif['daya']; ?> VA
                </option>
            <?php endwhile; ?>
        </select>
    </p>
    <p>
        <button type="submit">Simpan Pelanggan</button>
    </p>
</form>

<?php
require_once '../templates/footer.php';
?>