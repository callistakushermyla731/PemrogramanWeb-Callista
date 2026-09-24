<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $_SESSION['error'] = 'Silakan login terlebih dahulu.';
    header('Location: ../login.php');
    exit;
}
require_once '../includes/koneksi.php';

$id = (int)($_GET['id'] ?? 0);
$edit = cari_data('digicam', $id);

if (!$edit) {
    $_SESSION['error'] = 'Data digicam tidak ditemukan.';
    header('Location: list.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Digicam - DIGIRENT</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include '../includes/header.php'; ?>
<main class="container">
    <div class="form-card">
        <h2 style="color:#d63384; margin-bottom:1.5rem;">Edit Data Digicam</h2>
        <form action="proses_edit.php" method="post">
            <input type="hidden" name="id" value="<?= (int)$edit['id'] ?>">
            <div class="form-row">
                <div class="form-group">
                    <label for="nama">Nama Digicam</label>
                    <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($edit['nama']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="merek">Merek</label>
                    <input type="text" id="merek" name="merek" value="<?= htmlspecialchars($edit['merek']) ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <input type="text" id="tipe" name="tipe" value="<?= htmlspecialchars($edit['tipe']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="harga_sewa">Harga Sewa per Hari</label>
                    <input type="number" id="harga_sewa" name="harga_sewa" value="<?= (int)$edit['harga_sewa'] ?>" min="0" required>
                </div>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" id="stok" name="stok" value="<?= (int)$edit['stok'] ?>" min="0" required>
            </div>
            <div class="btn-group">
                <button type="submit" class="btn-pink">Update</button>
                <a href="list.php" class="btn-outline">Kembali</a>
            </div>
        </form>
    </div>
</main>
<?php include '../includes/footer.php'; ?>
</body>
</html>
