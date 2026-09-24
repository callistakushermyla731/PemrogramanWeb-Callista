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
$email = trim($_POST['email'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');

if ($nama === '' || $email === '' || $no_hp === '' || $alamat === '') {
    $_SESSION['error'] = 'Semua data pelanggan wajib diisi.';
    header('Location: tambah.php');
    exit;
}

$data = baca_data('pelanggan');
$data[] = [
    'id' => id_baru($data),
    'nama' => $nama,
    'email' => $email,
    'no_hp' => $no_hp,
    'alamat' => $alamat
];

if (simpan_data('pelanggan', $data)) {
    $_SESSION['pesan'] = 'Data pelanggan berhasil ditambahkan.';
} else {
    $_SESSION['error'] = 'Data pelanggan gagal ditambahkan.';
}
header('Location: list.php');
exit;
?>
