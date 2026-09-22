<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kamera = trim($_POST['nama_kamera'] ?? '');
    $kategori    = trim($_POST['kategori'] ?? '');
    $tarif       = trim($_POST['tarif_per_hari'] ?? '');
    $stok        = trim($_POST['stok'] ?? '');
    $kondisi     = trim($_POST['kondisi'] ?? '');

    // 1. Validasi Wajib Isi (Server-Side)
    if (empty($nama_kamera) || empty($kategori) || $tarif === '' || $stok === '' || empty($kondisi)) {
        $_SESSION['flash'] = [
            'type' => 'danger',
            'message' => 'Gagal menyimpan! Semua kolom formulir wajib diisi.'
        ];
        header('Location: tambah.php');
        exit;
    }

    // 2. Validasi Latihan 7.4: Tarif dan Stok Non-Negatif
    if ((float)$tarif < 0 || (int)$stok < 0) {
        $_SESSION['flash'] = [
            'type' => 'danger',
            'message' => 'Gagal menyimpan! Tarif dan stok tidak boleh bernilai negatif.'
        ];
        header('Location: tambah.php');
        exit;
    }

    // Format tarif per hari
    $formatted_tarif = "Rp " . number_format((float)$tarif, 0, ',', '.');

    // Buat data baru
    $data_baru = [
        'id' => time(),
        'nama_kamera' => $nama_kamera,
        'kategori' => $kategori,
        'tarif_per_hari' => $formatted_tarif,
        'stok' => (int)$stok,
        'kondisi' => $kondisi
    ];

    // Simpan ke array $_SESSION
    $_SESSION['digicam'][] = $data_baru;

    // Flash Message Sukses
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Unit Digicam berhasil ditambahkan.'
    ];

    header('Location: list.php');
    exit;
} else {
    header('Location: list.php');
    exit;
}