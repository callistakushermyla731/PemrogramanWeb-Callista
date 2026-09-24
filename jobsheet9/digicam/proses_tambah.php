<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $_SESSION['error'] = 'Silakan login terlebih dahulu.';
    header('Location: ../login.php');
    exit;
}
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$merek = trim($_POST['merek'] ?? '');
$tipe = trim($_POST['tipe'] ?? '');
$harga_sewa = (int)($_POST['harga_sewa'] ?? -1);
$stok = (int)($_POST['stok'] ?? -1);

if ($nama === '' || $merek === '' || $tipe === '' || $harga_sewa < 0 || $stok < 0) {
    $_SESSION['error'] = 'Semua data harus diisi dengan benar.';
    header('Location: tambah.php');
    exit;
}

$data = baca_data('digicam');
$data[] = [
    'id' => id_baru($data),
    'nama' => $nama,
    'merek' => $merek,
    'tipe' => $tipe,
    'harga_sewa' => $harga_sewa,
    'stok' => $stok
];

if (simpan_data('digicam', $data)) {
    $_SESSION['pesan'] = 'Digicam berhasil ditambahkan.';
} else {
    $_SESSION['error'] = 'Digicam gagal ditambahkan.';
}
header('Location: list.php');
exit;
?>
