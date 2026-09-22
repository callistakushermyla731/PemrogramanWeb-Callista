<?php
$depth = 0;
include 'includes/header.php';
?>

<section class="hero-card">
    <div class="hero-content">
        <span class="badge">Rental Kamera Y2K & Aesthetic</span>
        <h1>Sewa Digicam Impian untuk Momen Spesialmu</h1>
        <p>Kelola stok unit kamera digital saku, data penyewa, dan ketersediaan unit rental dengan praktis dan rapi.</p>
        <div class="btn-group">
            <a href="digicam/list.php" class="btn-pink">Lihat Katalog</a>
            <a href="digicam/tambah.php" class="btn-outline">Tambah Unit</a>
        </div>
    </div>
    <div class="notice-box">
        <h3>📢 Ketentuan Rental</h3>
        <ul>
            <li>📌 Wajib menyertakan identitas asli (KTP/KTM).</li>
            <li>📌 Durasi sewa dihitung 24 jam sejak pengambilan.</li>  
            <li>📌 Sudah termasuk memory card & pouch kamera.</li>
        </ul>
    </div>
</section>

<section class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <p>Total Unit Kamera</p>
            <h2><?= count($_SESSION['digicam']); ?></h2>
        </div>
        <div class="stat-icon">📸</div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <p>Pelanggan Terdaftar</p>
            <h2><?= count($_SESSION['pelanggan']); ?></h2>
        </div>
        <div class="stat-icon">👥</div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <p>Sedang Disewa</p>
            <h2>2</h2>
        </div>
        <div class="stat-icon">✨</div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>