<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pelanggan = trim($_POST['id_pelanggan'] ?? '');
    $nama         = trim($_POST['nama'] ?? '');
    $kontak       = trim($_POST['kontak'] ?? '');
    $email        = trim($_POST['email'] ?? '');

    // 1. Validasi Wajib Isi
    if (empty($id_pelanggan) || empty($nama) || empty($kontak) || empty($email)) {
        $_SESSION['flash'] = [
            'type' => 'danger',
            'message' => 'Gagal mendaftar! Semua kolom inputan wajib diisi.'
        ];
        header('Location: tambah.php');
        exit;
    }

    // 2. Validasi Latihan 7.4: Format No. WhatsApp menggunakan preg_match()
    // Memastikan kontak hanya berisi angka, spasi, atau tanda tambah (+) di awal
    if (!preg_match('/^\+?[0-9\s\-]+$/', $kontak)) {
        $_SESSION['flash'] = [
            'type' => 'danger',
            'message' => 'Gagal mendaftar! Format No. WhatsApp hanya boleh berisi angka, tanda hubung, atau tanda (+).'
        ];
        header('Location: tambah.php');
        exit;
    }

    // Buat data baru
    $data_baru = [
        'id' => time(),
        'id_pelanggan' => $id_pelanggan,
        'nama' => $nama,
        'kontak' => $kontak,
        'email' => $email
    ];

    // Simpan ke array $_SESSION
    $_SESSION['pelanggan'][] = $data_baru;

    // Flash Message Sukses
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Pelanggan berhasil didaftarkan.'
    ];

    header('Location: list.php');
    exit;
} else {
    header('Location: list.php');
    exit;
}