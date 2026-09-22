<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "jobsheet8";

$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Koneksi MySQL gagal: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
$conn->select_db($db);
$conn->set_charset("utf8mb4");

/* Membuat tabel otomatis agar project langsung bisa dipakai. */
$conn->query("
    CREATE TABLE IF NOT EXISTS pelanggan (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        no_hp VARCHAR(30) NOT NULL,
        alamat VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB
");

$conn->query("
    CREATE TABLE IF NOT EXISTS diagram (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        keterangan TEXT NOT NULL
    ) ENGINE=InnoDB
");

/* Data awal hanya dimasukkan jika tabel masih kosong. */
$cek_pelanggan = $conn->query("SELECT COUNT(*) AS jumlah FROM pelanggan")->fetch_assoc();
if ((int)$cek_pelanggan["jumlah"] === 0) {
    $conn->query("
        INSERT INTO pelanggan (nama, email, no_hp, alamat) VALUES
        ('Callista', 'callista@gmail.com', '081234567890', 'Malang'),
        ('Dimas', 'dimas@gmail.com', '082345678901', 'Blitar')
    ");
}

$cek_diagram = $conn->query("SELECT COUNT(*) AS jumlah FROM diagram")->fetch_assoc();
if ((int)$cek_diagram["jumlah"] === 0) {
    $conn->query("
        INSERT INTO diagram (nama, keterangan) VALUES
        ('Diagram Data Pelanggan', 'Menampilkan data pelanggan yang tersimpan.'),
        ('Diagram Penjualan', 'Menampilkan informasi penjualan.')
    ");
}
?>