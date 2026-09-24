<?php
session_start();
require_once '../includes/koneksi.php';

$data = baca_data('pelanggan');
usort($data, function ($a, $b) {
    return (int)$b['id'] <=> (int)$a['id'];
});

$keyword = isset($_GET['keyword']) && is_string($_GET['keyword'])
    ? trim($_GET['keyword'])
    : '';

if ($keyword !== '') {
    $data = array_values(array_filter($data, function ($row) use ($keyword) {
        $nama = isset($row['nama']) ? (string)$row['nama'] : '';
        $email = isset($row['email']) ? (string)$row['email'] : '';
        $no_hp = isset($row['no_hp']) ? (string)$row['no_hp'] : '';

        return stripos($nama, $keyword) !== false
            || stripos($email, $keyword) !== false
            || stripos($no_hp, $keyword) !== false;
    }));
}

$per_halaman = 10;
$total_data = count($data);
$total_halaman = max(1, (int)ceil($total_data / $per_halaman));
$halaman_input = isset($_GET['halaman']) && is_scalar($_GET['halaman'])
    ? (int)$_GET['halaman']
    : 1;
$halaman = max(1, min($halaman_input, $total_halaman));
$offset = ($halaman - 1) * $per_halaman;
$data_halaman = array_slice($data, $offset, $per_halaman);
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Pelanggan - DIGIRENT</title><link rel="stylesheet" href="../assets/css/style.css"></head>
<body>
<?php include '../includes/header.php'; ?>
<main class="container">
<?php if (isset($_SESSION['pesan'])): ?><div class="alert alert-success"><?= htmlspecialchars($_SESSION['pesan']) ?></div><?php unset($_SESSION['pesan']); endif; ?>
<?php if (isset($_SESSION['error'])): ?><div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div><?php unset($_SESSION['error']); endif; ?>
<div class="table-card">
<div class="table-header"><div><h2>Daftar Pelanggan</h2><p>Daftar pelanggan yang terdaftar di DIGIRENT.</p></div>
<?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?><a href="tambah.php" class="btn-pink">+ Tambah Pelanggan</a><?php endif; ?></div>

<form method="get" action="list.php" class="search-form">
<div class="search-input-wrap">
<span class="search-icon">⌕</span>
<input type="text" name="keyword" value="<?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') ?>" placeholder="Cari nama, email, atau nomor HP...">
</div>
<div class="search-actions">
<button type="submit" class="btn-pink">Cari</button>
<?php if ($keyword !== ''): ?><a href="list.php" class="btn-outline">Reset</a><?php endif; ?>
</div>
</form>

<div class="table-responsive"><table><thead><tr><th>No</th><th>Nama</th><th>Email</th><th>No. HP</th><th>Alamat</th><?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?><th>Aksi</th><?php endif; ?></tr></thead>
<tbody>
<?php if (count($data_halaman) > 0): ?>
<?php $no=$offset+1; foreach($data_halaman as $row): ?><tr>
<td><?= $no++ ?></td><td><?= htmlspecialchars($row['nama']) ?></td><td><?= htmlspecialchars($row['email']) ?></td><td><?= htmlspecialchars($row['no_hp']) ?></td><td><?= htmlspecialchars($row['alamat']) ?></td>
<?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?><td class="actions">
<a href="edit.php?id=<?= (int)$row['id'] ?>" class="btn-action btn-edit">Edit</a>
<form action="hapus.php" method="post" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data pelanggan ini?')">
<input type="hidden" name="id" value="<?= (int)$row['id'] ?>"><button type="submit" class="btn-action btn-delete">Hapus</button>
</form></td><?php endif; ?></tr><?php endforeach; ?>
<?php else: ?><tr><td colspan="6" class="empty-state">Belum ada data pelanggan.</td></tr><?php endif; ?>
</tbody></table></div>
<?php if ($total_halaman > 1): ?><div class="pagination" style="margin-top:1rem; display:flex; gap:.5rem; align-items:center;">
<?php if($halaman>1): ?><a class="btn-outline" href="?keyword=<?= urlencode($keyword) ?>&halaman=<?= $halaman-1 ?>">Sebelumnya</a><?php endif; ?>
<span>Halaman <?= $halaman ?> dari <?= $total_halaman ?></span>
<?php if($halaman<$total_halaman): ?><a class="btn-outline" href="?keyword=<?= urlencode($keyword) ?>&halaman=<?= $halaman+1 ?>">Berikutnya</a><?php endif; ?>
</div><?php endif; ?>
</div></main>
<?php include '../includes/footer.php'; ?>
</body></html>
