<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIGIRENT</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<main class="container">
    <?php if (isset($_SESSION["pesan"])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION["pesan"]) ?>
        </div>
        <?php unset($_SESSION["pesan"]); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION["error"])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION["error"]) ?>
        </div>
        <?php unset($_SESSION["error"]); ?>
    <?php endif; ?>

    <section class="hero-card">
        <div class="hero-content">
            <span class="badge">PHP & MYSQL</span>
            <h1>Selamat Datang di DIGIRENT</h1>
            <p>
                Website sederhana untuk mengelola data diagram dan pelanggan.
                Silakan login jika ingin menggunakan fitur tambah, edit, dan hapus data.
            </p>

            <div class="btn-group">
                <?php if (isset($_SESSION["login"]) && $_SESSION["login"] === true): ?>
                    <a href="pelanggan/list.php" class="btn-pink">Kelola Pelanggan</a>
                    <a href="diagram/list.php" class="btn-outline">Lihat Diagram</a>
                <?php else: ?>
                    <a href="login.php" class="btn-pink">Login</a>
                    <a href="pelanggan/list.php" class="btn-outline">Lihat Pelanggan</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="notice-box">
            <h3>Informasi Login</h3>
            <ul>
                <li>📧 Username: admindigirent123@gmail.com</li>
                <li>🔑 Password: 12345678</li>
                <li>✅ Setelah login muncul nama akun</li>
                <li>🗑️ Data dapat dihapus satu per satu</li>
            </ul>
        </div>
    </section>

    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <p>Status</p>
                <h2><?= isset($_SESSION["login"]) && $_SESSION["login"] === true ? "Login" : "Guest" ?></h2>
            </div>
            <div class="stat-icon">👤</div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <p>Menu</p>
                <h2>2</h2>
            </div>
            <div class="stat-icon">📋</div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <p>CRUD</p>
                <h2>Aktif</h2>
            </div>
            <div class="stat-icon">⚙️</div>
        </div>
    </section>
</main>

<?php include "includes/footer.php"; ?>
</body>
</html>

