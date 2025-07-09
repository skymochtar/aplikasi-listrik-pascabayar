<?php
$page_title = "Registrasi Pelanggan";
require_once '../config/database.php';
require_once '../templates/header.php'; // Panggil header

$tariffs = mysqli_query($conn, "SELECT * FROM tarif");
?>

<div class="auth-container">
    <div class="card">
        <h1>Registrasi Akun Baru</h1>
            
        <form action="proses_register.php" method="POST" id="registerForm">
            <p>
                <label>Nama Lengkap:</label>
                <input type="text" name="nama_pelanggan" required>
            </p>
            <p>
                <label>Username:</label>
                <input type="text" name="username" required>
            </p>
            <p>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </p>
            <p>
                <label for="confirm_password">Konfirmasi Password:</label>
                <input type="password" id="confirm_password" required>
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
                <label>Pilih Tarif Listrik:</label>
                <select name="id_tarif" required>
                    <option value="">-- Pilih Daya --</option>
                    <?php while($tarif = mysqli_fetch_assoc($tariffs)): ?>
                        <option value="<?php echo $tarif['id_tarif']; ?>">
                            <?php echo $tarif['daya']; ?> VA
                        </option>
                    <?php endwhile; ?>
                </select>
            </p>
            <button type="submit">Daftar</button>
        </form>
        <br>
        <p style="text-align:center;">Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</div>

<?php
// Kita tidak memanggil footer di sini agar layout auth-container bekerja
?>
<script src="<?php echo BASE_URL; ?>/assets/script.js"></script>
</body>
</html>