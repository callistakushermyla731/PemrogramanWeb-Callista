<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Menghitung path relatif otomatis berdasarkan lokasi file yang memanggil
$base = isset($depth) && $depth > 0 ? str_repeat('../', $depth) : '';

// Inisialisasi awal data dummy di $_SESSION jika belum ada
if (!isset($_SESSION['digicam'])) {
    $_SESSION['digicam'] = [
        ['id' => 1, 'nama_kamera' => 'Canon IXY 650', 'kategori' => 'CCD Sensor', 'tarif_per_hari' => 'Rp 50.000', 'stok' => 3, 'kondisi' => 'Sangat Baik'],
        ['id' => 2, 'nama_kamera' => 'Sony Cyber-shot W830', 'kategori' => 'Compact', 'tarif_per_hari' => 'Rp 65.000', 'stok' => 2, 'kondisi' => 'Mulus'],
        ['id' => 3, 'nama_kamera' => 'Nikon Coolpix S3300', 'kategori' => 'Vintage Y2K', 'tarif_per_hari' => 'Rp 55.000', 'stok' => 1, 'kondisi' => 'Baik']
    ];
}

if (!isset($_SESSION['pelanggan'])) {
    $_SESSION['pelanggan'] = [
        ['id' => 1, 'id_pelanggan' => 'CUST-001', 'nama' => 'Callista Kushermyla', 'kontak' => '08123456789', 'email' => 'callista@example.com'],
        ['id' => 2, 'id_pelanggan' => 'CUST-002', 'nama' => 'Nabila Putri', 'kontak' => '08987654321', 'email' => 'nabila@example.com']
    ];
}

// Menentukan halaman aktif untuk highlight navbar
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIGIRENT | Management System</title>
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <a href="<?= $base ?>index.php" class="brand-title">DIGIRENT</a>
            
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
            <label for="menu-toggle" class="hamburger-btn">☰</label>

            <nav>
                <ul>
                    <li><a href="<?= $base ?>index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Beranda</a></li>
                    <li><a href="<?= $base ?>digicam/list.php" class="<?= ($current_page == 'list.php' && strpos($_SERVER['PHP_SELF'], 'digicam') !== false) ? 'active' : '' ?>">Katalog Digicam</a></li>
                    <li><a href="<?= $base ?>digicam/tambah.php" class="<?= ($current_page == 'tambah.php' && strpos($_SERVER['PHP_SELF'], 'digicam') !== false) ? 'active' : '' ?>">Tambah Digicam</a></li>
                    <li><a href="<?= $base ?>pelanggan/list.php" class="<?= ($current_page == 'list.php' && strpos($_SERVER['PHP_SELF'], 'pelanggan') !== false) ? 'active' : '' ?>">Daftar Pelanggan</a></li>
                    <li><a href="<?= $base ?>pelanggan/tambah.php" class="<?= ($current_page == 'tambah.php' && strpos($_SERVER['PHP_SELF'], 'pelanggan') !== false) ? 'active' : '' ?>">Tambah Pelanggan</a></li>
                    <li><a href="<?= $base ?>login.php" class="btn-login <?= $current_page == 'login.php' ? 'active' : '' ?>">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <!-- Render Flash Message dari $_SESSION['flash'] -->
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] ?>">
                <?= $_SESSION['flash']['message'] ?>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>