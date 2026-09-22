<?php
session_start();

// Mengosongkan semua data $_SESSION
session_unset();

// Mengancurkan session di server
session_destroy();

// Mulai session baru untuk mengirimkan pesan flash
session_start();
$_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Seluruh data session telah berhasil di-reset ke pengaturan awal.'
];

header('Location: index.php');
exit;