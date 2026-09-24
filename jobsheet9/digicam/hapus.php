<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $_SESSION['error'] = 'Silakan login terlebih dahulu.';
    header('Location: ../login.php');
    exit;
}
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = 'Penghapusan data harus menggunakan method POST.';
    header('Location: list.php');
    exit;
}

$id = (int)($_POST['id'] ?? 0);
$data = baca_data('digicam');
$baru = [];
$ditemukan = false;

foreach ($data as $row) {
    if ((int)$row['id'] === $id) {
        $ditemukan = true;
        continue;
    }
    $baru[] = $row;
}

if ($ditemukan && simpan_data('digicam', $baru)) {
    $_SESSION['pesan'] = 'Data digicam berhasil dihapus.';
} else {
    $_SESSION['error'] = 'Data digicam tidak ditemukan atau gagal dihapus.';
}
header('Location: list.php');
exit;
?>
