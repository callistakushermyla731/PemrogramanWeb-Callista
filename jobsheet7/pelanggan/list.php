<?php
$depth = 1;
include '../includes/header.php';
?>

<div class="table-card">
    <div class="table-header">
        <div>
            <h2>Direktori Pelanggan</h2>
            <p>Menampilkan <?= count($_SESSION['pelanggan']); ?> total data</p>
        </div>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="padding-left: 1.5rem;">ID Pelanggan</th>
                    <th>Nama Lengkap</th>
                    <th>No. WhatsApp</th>
                    <th>Email</th>
                    <th style="text-align: right; padding-right: 1.5rem;">Kelola</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($_SESSION['pelanggan'])): ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 1.5rem;">Data pelanggan masih kosong.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($_SESSION['pelanggan'] as $cust): ?>
                        <tr>
                            <td style="padding-left: 1.5rem; font-weight: 600;"><?= htmlspecialchars($cust['id_pelanggan']) ?></td>
                            <td><?= htmlspecialchars($cust['nama']) ?></td>
                            <td><?= htmlspecialchars($cust['kontak']) ?></td>
                            <td><?= htmlspecialchars($cust['email']) ?></td>
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