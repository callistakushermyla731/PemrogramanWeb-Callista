<?php
$depth = 1;
include '../includes/header.php';
?>

<div class="form-card">
    <h2 style="color:#d63384; margin-bottom: 0.4rem;">Tambah Unit Digicam Baru</h2>
    <p style="color:#777; font-size: 0.85rem; margin-bottom: 1.5rem;">Isi detail spesifikasi kamera untuk menambahkan koleksi rental baru.</p>

    <form action="proses_tambah.php" method="POST">
        <div class="form-group">
            <label>Nama Tipe Kamera</label>
            <input type="text" name="nama_kamera" placeholder="Misal: Canon IXY 650" required>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" required>
                    <option value="">Pilih Kategori...</option>
                    <option value="CCD Sensor">CCD Sensor</option>
                    <option value="Compact">Compact</option>
                    <option value="Vintage Y2K">Vintage Y2K</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tarif Per Hari (Rp)</label>
                <input type="number" name="tarif_per_hari" placeholder="50000" required>
            </div>
        </div>
        <div class="form-row" style="margin-bottom: 1.5rem;">
            <div class="form-group">
                <label>Jumlah Stok Ready</label>
                <input type="number" name="stok" placeholder="1" required>
            </div>
            <div class="form-group">
                <label>Kondisi Fisik</label>
                <input type="text" name="kondisi" placeholder="Misal: Mulus 95%" required>
            </div>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 0.8rem;">
            <a href="list.php" class="btn-outline">Batal</a>
            <button type="submit" class="btn-pink">Simpan Unit</button>
        </div>
    </form>
</div>

<?php include '../includes/footer.php'; ?>