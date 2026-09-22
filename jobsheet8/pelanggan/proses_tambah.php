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

    $stmt = $conn->prepare("DELETE FROM pelanggan WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION["pesan"] = "Data pelanggan berhasil dihapus.";
    } else {
        $_SESSION["error"] = "Data pelanggan gagal dihapus.";
    }

    header("Location: list.php");
    exit;
}

if (isset($_POST["simpan"])) {
    $nama = trim($_POST["nama"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $no_hp = trim($_POST["no_hp"] ?? "");
    $alamat = trim($_POST["alamat"] ?? "");

    $stmt = $conn->prepare("
        INSERT INTO pelanggan (nama, email, no_hp, alamat)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->bind_param("ssss", $nama, $email, $no_hp, $alamat);

    if ($stmt->execute()) {
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

    $stmt = $conn->prepare("
        UPDATE pelanggan
        SET nama = ?, email = ?, no_hp = ?, alamat = ?
        WHERE id = ?
    ");
    $stmt->bind_param("ssssi", $nama, $email, $no_hp, $alamat, $id);

    if ($stmt->execute()) {
        $_SESSION["pesan"] = "Data pelanggan berhasil diubah.";
    } else {
        $_SESSION["error"] = "Data pelanggan gagal diubah.";
    }

    header("Location: list.php");
    exit;
}

header("Location: list.php");
exit;
