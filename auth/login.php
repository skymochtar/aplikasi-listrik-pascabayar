<?php
$page_title = "Login";
require_once '../config/database.php';

// Cek jika sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['role'])) {
    header("Location: " . ($_SESSION['role'] == 'admin' ? '../admin/index.php' : '../pelanggan/index.php'));
    exit();
}

// Untuk halaman login, kita tidak pakai header/footer standar agar bisa full-page
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Listrik Pascabayar</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="card">
            <h1>Silakan Login</h1>
            
            <?php if (isset($_GET['success'])): ?>
                <p style="color:green; text-align:center;"><?php echo htmlspecialchars($_GET['success']); ?></p>
            <?php endif; ?>
            <?php if (isset($_GET['error'])): ?>
                <p style="color:red; text-align:center;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <form action="proses_login.php" method="POST">
                <p>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </p>
                <p>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </p>
                <button type="submit">Login</button>
            </form>
            <br>
            <p style="text-align:center;">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>