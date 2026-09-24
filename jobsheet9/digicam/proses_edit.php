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

$id = (int)($_POST['id'] ?? 0);
$nama = trim($_POST['nama'] ?? '');
$merek = trim($_POST['merek'] ?? '');
$tipe = trim($_POST['tipe'] ?? '');
$harga_sewa = (int)($_POST['harga_sewa'] ?? -1);
$stok = (int)($_POST['stok'] ?? -1);

if ($id <= 0 || $nama === '' || $merek === '' || $tipe === '' || $harga_sewa < 0 || $stok < 0) {
    $_SESSION['error'] = 'Data belum lengkap atau tidak valid.';
    header('Location: edit.php?id=' . $id);
    exit;
}

$data = baca_data('digicam');
$ditemukan = false;

foreach ($data as &$row) {
    if ((int)$row['id'] === $id) {
        $row['nama'] = $nama;
        $row['merek'] = $merek;
        $row['tipe'] = $tipe;
        $row['harga_sewa'] = $harga_sewa;
        $row['stok'] = $stok;
        $ditemukan = true;
        break;
    }
}
unset($row);

if ($ditemukan && simpan_data('digicam', $data)) {
    $_SESSION['pesan'] = 'Data digicam berhasil diperbarui.';
} else {
    $_SESSION['error'] = 'Data digicam gagal diperbarui.';
}
header('Location: list.php');
exit;
?>
