<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Kredensial Akses Admin
    $valid_username = 'admindigirent123';
    $valid_password = '12345678';

    if ($username === $valid_username && $password === $valid_password) {
        // Simpan session login
        $_SESSION['user'] = [
            'username' => $username,
            'role' => 'admin'
        ];

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Selamat datang kembali, Admin DIGIRENT!'
        ];

        header('Location: index.php');
        exit;
    } else {
        $_SESSION['flash'] = [
            'type' => 'danger',
            'message' => 'Username atau password yang kamu masukkan salah!'
        ];

        header('Location: login.php');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}