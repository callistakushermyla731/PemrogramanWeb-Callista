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
$email = trim($_POST['email'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');

if ($id <= 0 || $nama === '' || $email === '' || $no_hp === '' || $alamat === '') {
    $_SESSION['error'] = 'Data belum lengkap atau tidak valid.';
    header('Location: edit.php?id=' . $id);
    exit;
}

$data = baca_data('pelanggan');
$ditemukan = false;
foreach ($data as &$row) {
    if ((int)$row['id'] === $id) {
        $row['nama'] = $nama;
        $row['email'] = $email;
        $row['no_hp'] = $no_hp;
        $row['alamat'] = $alamat;
        $ditemukan = true;
        break;
    }
}
unset($row);

if ($ditemukan && simpan_data('pelanggan', $data)) {
    $_SESSION['pesan'] = 'Data pelanggan berhasil diperbarui.';
} else {
    $_SESSION['error'] = 'Data pelanggan gagal diperbarui.';
}
header('Location: list.php');
exit;
?>
