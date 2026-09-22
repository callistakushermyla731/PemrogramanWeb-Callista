<?php
$depth = 1;
include '../includes/header.php';
?>

<div class="table-card">
    <div class="table-header">
        <div>
            <h2>Katalog Unit Digicam</h2>
            <p>Menampilkan <?= count($_SESSION['digicam']); ?> total data</p>
        </div>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="padding-left: 1.5rem;">Nama Kamera</th>
                    <th>Kategori</th>
                    <th>Tarif / Hari</th>
                    <th>Stok Ready</th>
                    <th>Kondisi</th>
                    <th style="text-align: right; padding-right: 1.5rem;">Kelola</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($_SESSION['digicam'])): ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 1.5rem;">Data digicam masih kosong.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($_SESSION['digicam'] as $cam): ?>
                        <tr>
                            <td style="padding-left: 1.5rem; font-weight: 600;"><?= htmlspecialchars($cam['nama_kamera']) ?></td>
                            <td><?= htmlspecialchars($cam['kategori']) ?></td>
                            <td><?= htmlspecialchars($cam['tarif_per_hari']) ?></td>
                            <td><?= htmlspecialchars($cam['stok']) ?></td>
                            <td><?= htmlspecialchars($cam['kondisi']) ?></td>
                            <td style="text-align: right; padding-right: 1.5rem;">
                                <button class="btn-action btn-edit" onclick="alert('Fitur edit dibuka!')">Edit</button>
                                <button class="btn-action btn-delete" onclick="alert('Fitur hapus dibuka!')">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>