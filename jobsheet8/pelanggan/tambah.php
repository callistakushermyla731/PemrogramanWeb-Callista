<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    $_SESSION["error"] = "Silakan login terlebih dahulu.";
    header("Location: ../login.php");
    exit;
}

require_once "../includes/koneksi.php";

$edit = null;
if (isset($_GET["edit"])) {
    $edit = cari_data('pelanggan', (int)$_GET["edit"]);

    if (!$edit) {
        $_SESSION["error"] = "Data tidak ditemukan.";
        header("Location: list.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $edit ? "Edit" : "Tambah" ?> Pelanggan - DIGIRENT</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include "../includes/header.php"; ?>

<main class="container">
    <div class="form-card">
        <h2 style="color:#d63384; margin-bottom:1.5rem;">
            <?= $edit ? "Edit Data Pelanggan" : "Tambah Pelanggan" ?>
        </h2>

        <form action="proses_tambah.php" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($edit["id"] ?? "") ?>">

            <div class="form-row">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($edit["nama"] ?? "") ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($edit["email"] ?? "") ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="no_hp">No. HP</label>
                    <input type="tel" id="no_hp" name="no_hp" value="<?= htmlspecialchars($edit["no_hp"] ?? "") ?>" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="<?= htmlspecialchars($edit["alamat"] ?? "") ?>" required>
                </div>
            </div>

            <div class="btn-group">
                <button type="submit" name="<?= $edit ? "update" : "simpan" ?>" class="btn-pink">
                    <?= $edit ? "Update" : "Simpan" ?>
                </button>
                <a href="list.php" class="btn-outline">Kembali</a>
            </div>
        </form>
    </div>
</main>

<?php include "../includes/footer.php"; ?>
</body>
</html>
