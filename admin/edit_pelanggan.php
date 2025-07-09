<?php
$page_title = "Edit Pelanggan";
require_once '../config/database.php';
require_once '../templates/header.php';

// Proteksi Halaman & Cek ID
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin' || !isset($_GET['id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$id_pelanggan = $_GET['id'];

// Ambil data pelanggan yang akan diedit
$result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = $id_pelanggan");
$pelanggan = mysqli_fetch_assoc($result);

// Ambil semua data tarif untuk dropdown
$tariffs = mysqli_query($conn, "SELECT * FROM tarif");

if (!$pelanggan) {
    header("Location: kelola_pelanggan.php");
    exit();
}
?>

<h1>Form Edit Pelanggan</h1>
<a href="kelola_pelanggan.php" class="btn">Kembali</a>
<br><br>

<form action="proses_edit_pelanggan.php" method="POST">
    <input type="hidden" name="id_pelanggan" value="<?php echo $pelanggan['id_pelanggan']; ?>">
    
    <p>
        <label>Nama Pelanggan:</label>
        <input type="text" name="nama_pelanggan" value="<?php echo htmlspecialchars($pelanggan['nama_pelanggan']); ?>" required>
    </p>
    <p>
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($pelanggan['username']); ?>" required>
    </p>
    <p>
        <label>Nomor KWH:</label>
        <input type="text" name="nomor_kwh" value="<?php echo htmlspecialchars($pelanggan['nomor_kwh']); ?>" required>
    </p>
    <p>
        <label>Alamat:</label>
        <textarea name="alamat" required><?php echo htmlspecialchars($pelanggan['alamat']); ?></textarea>
    </p>
    <p>
        <label>Tarif Listrik:</label>
        <select name="id_tarif" required>
            <?php while($tarif = mysqli_fetch_assoc($tariffs)): ?>
                <option value="<?php echo $tarif['id_tarif']; ?>" <?php echo ($tarif['id_tarif'] == $pelanggan['id_tarif']) ? 'selected' : ''; ?>>
                    <?php echo $tarif['daya']; ?> VA
                </option>
            <?php endwhile; ?>
        </select>
    </p>
    <p>
        <button type="submit">Update Pelanggan</button>
    </p>
</form>

<?php
require_once '../templates/footer.php';
?>