<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $_SESSION['error'] = 'Silakan login terlebih dahulu.';
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Pelanggan - DIGIRENT</title><link rel="stylesheet" href="../assets/css/style.css"></head>
<body>
<?php include '../includes/header.php'; ?>
<main class="container"><div class="form-card">
<h2 style="color:#d63384; margin-bottom:1.5rem;">Tambah Pelanggan</h2>
<form action="proses_tambah.php" method="post">
<div class="form-row"><div class="form-group"><label for="nama">Nama</label><input type="text" id="nama" name="nama" required></div>
<div class="form-group"><label for="email">Email</label><input type="email" id="email" name="email" required></div></div>
<div class="form-row"><div class="form-group"><label for="no_hp">No. HP</label><input type="tel" id="no_hp" name="no_hp" required></div>
<div class="form-group"><label for="alamat">Alamat</label><input type="text" id="alamat" name="alamat" required></div></div>
<div class="btn-group"><button type="submit" class="btn-pink">Simpan</button><a href="list.php" class="btn-outline">Kembali</a></div>
</form></div></main>
<?php include '../includes/footer.php'; ?>
</body></html>
