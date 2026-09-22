<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pelanggan = trim($_POST['id_pelanggan'] ?? '');
    $nama         = trim($_POST['nama'] ?? '');
    $kontak       = trim($_POST['kontak'] ?? '');
    $email        = trim($_POST['email'] ?? '');

    // Validasi Sisi Server
    if (empty($id_pelanggan) || empty($nama) || empty($kontak) || empty($email)) {
        $_SESSION['flash'] = [
            'type' => 'danger',
            'message' => 'Gagal mendaftar! Semua kolom inputan wajib diisi.'
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

    // Set flash message sukses
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Pelanggan baru berhasil didaftarkan!'
    ];

    // Redirect ke list.php
    header('Location: list.php');
    exit;
} else {
    header('Location: list.php');
    exit;
}