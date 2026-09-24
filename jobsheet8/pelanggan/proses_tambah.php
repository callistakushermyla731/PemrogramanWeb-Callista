<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    $_SESSION["error"] = "Silakan login terlebih dahulu.";
    header("Location: ../login.php");
    exit;
}

require_once "../includes/koneksi.php";

if (isset($_GET["hapus"])) {
    $id = (int)$_GET["hapus"];
    $data = baca_data('pelanggan');
    $baru = [];
    $ditemukan = false;

    foreach ($data as $row) {
        if ((int)$row['id'] === $id) {
            $ditemukan = true;
            continue;
        }
        $baru[] = $row;
    }

    if ($ditemukan && simpan_data('pelanggan', $baru)) {
        $_SESSION["pesan"] = "Data pelanggan berhasil dihapus.";
    } else {
        $_SESSION["error"] = "Data pelanggan tidak ditemukan atau gagal dihapus.";
    }

    header("Location: list.php");
    exit;
}

if (isset($_POST["simpan"])) {
    $nama = trim($_POST["nama"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $no_hp = trim($_POST["no_hp"] ?? "");
    $alamat = trim($_POST["alamat"] ?? "");

    if ($nama === '' || $email === '' || $no_hp === '' || $alamat === '') {
        $_SESSION["error"] = "Semua data pelanggan wajib diisi.";
        header("Location: tambah.php");
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
        $_SESSION["pesan"] = "Data pelanggan berhasil ditambahkan.";
    } else {
        $_SESSION["error"] = "Data pelanggan gagal ditambahkan.";
    }

    header("Location: list.php");
    exit;
}

if (isset($_POST["update"])) {
    $id = (int)($_POST["id"] ?? 0);
    $nama = trim($_POST["nama"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $no_hp = trim($_POST["no_hp"] ?? "");
    $alamat = trim($_POST["alamat"] ?? "");

    if ($id <= 0 || $nama === '' || $email === '' || $no_hp === '' || $alamat === '') {
        $_SESSION["error"] = "Data pelanggan belum lengkap.";
        header("Location: list.php");
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
        $_SESSION["pesan"] = "Data pelanggan berhasil diubah.";
    } else {
        $_SESSION["error"] = "Data pelanggan gagal diubah.";
    }

    header("Location: list.php");
    exit;
}

header("Location: list.php");
exit;
?>
