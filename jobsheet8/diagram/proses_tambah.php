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

    $stmt = $conn->prepare("DELETE FROM diagram WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION["pesan"] = "Data diagram berhasil dihapus.";
    } else {
        $_SESSION["error"] = "Data diagram gagal dihapus.";
    }

    header("Location: list.php");
    exit;
}

if (isset($_POST["simpan"])) {
    $nama = trim($_POST["nama"] ?? "");
    $keterangan = trim($_POST["keterangan"] ?? "");

    $stmt = $conn->prepare("INSERT INTO diagram (nama, keterangan) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $keterangan);

    if ($stmt->execute()) {
        $_SESSION["pesan"] = "Data diagram berhasil ditambahkan.";
    } else {
        $_SESSION["error"] = "Data diagram gagal ditambahkan.";
    }

    header("Location: list.php");
    exit;
}

if (isset($_POST["update"])) {
    $id = (int)($_POST["id"] ?? 0);
    $nama = trim($_POST["nama"] ?? "");
    $keterangan = trim($_POST["keterangan"] ?? "");

    $stmt = $conn->prepare("UPDATE diagram SET nama = ?, keterangan = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nama, $keterangan, $id);

    if ($stmt->execute()) {
        $_SESSION["pesan"] = "Data diagram berhasil diubah.";
    } else {
        $_SESSION["error"] = "Data diagram gagal diubah.";
    }

    header("Location: list.php");
    exit;
}

header("Location: list.php");
exit;
