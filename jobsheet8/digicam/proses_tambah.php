<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $_SESSION['error'] = 'Silakan login terlebih dahulu.';
    header('Location: ../login.php');
    exit;
}

require_once '../includes/koneksi.php';

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
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
        $_SESSION['error'] = 'Data digicam tidak ditemukan.';
    }

    header('Location: list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$merek = trim($_POST['merek'] ?? '');
$tipe = trim($_POST['tipe'] ?? '');
$harga_sewa = (int)($_POST['harga_sewa'] ?? 0);
$stok = (int)($_POST['stok'] ?? 0);
$id = (int)($_POST['id'] ?? 0);

if ($nama === '' || $merek === '' || $tipe === '' || $harga_sewa < 0 || $stok < 0) {
    $_SESSION['error'] = 'Semua data harus diisi dengan benar.';
    header('Location: ' . ($id > 0 ? 'tambah.php?edit=' . $id : 'tambah.php'));
    exit;
}

$data = baca_data('digicam');

if (isset($_POST['update']) && $id > 0) {
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
} else {
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
}

header('Location: list.php');
exit;
