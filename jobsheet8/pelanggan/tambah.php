<?php
$depth = 1;
include '../includes/header.php';
?>

<div class="form-card">
    <h2 style="color:#d63384; margin-bottom: 0.4rem;">Registrasi Pelanggan Baru</h2>
    <p style="color:#777; font-size: 0.85rem; margin-bottom: 1.5rem;">Input data penyewa untuk verifikasi identitas rental kamera.</p>

    <form action="proses_tambah.php" method="POST">
        <div class="form-row">
            <div class="form-group">
                <label>ID Pelanggan / KTP</label>
                <input type="text" name="id_pelanggan" placeholder="CUST-00X" required>
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Nama penyewa..." required>
            </div>
        </div>
        <div class="form-row" style="margin-bottom: 1.5rem;">
            <div class="form-group">
                <label>No. WhatsApp</label>
                <input type="tel" name="kontak" placeholder="08XXXXXXXXXX" required>
            </div>
            <div class="form-group">
                <label>Email Active</label>
                <input type="email" name="email" placeholder="email@domain.com" required>
            </div>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 0.8rem;">
            <a href="list.php" class="btn-outline">Batal</a>
            <button type="submit" class="btn-pink">Daftarkan Pelanggan</button>
        </div>
    </form>
</div>

<?php include '../includes/footer.php'; ?>