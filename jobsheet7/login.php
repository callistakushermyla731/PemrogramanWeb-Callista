<?php
$depth = 0;
include 'includes/header.php';
?>

<div class="form-card" style="max-width: 420px; text-align: center;">
    <span style="font-size: 2.5rem;">🔑</span>
    <h2 style="color: #d63384; margin-top: 0.5rem; margin-bottom: 0.3rem;">Masuk Admin</h2>
    <p style="color: #777; font-size: 0.85rem; margin-bottom: 1.8rem;">Silakan masuk ke panel manajemen</p>
    
    <form action="index.php" method="GET" style="text-align: left;">
        <div class="form-group">
            <label>Username / Email</label>
            <input type="text" placeholder="admin@digirent.com" required>
        </div>
        <div class="form-group" style="margin-bottom: 1.8rem;">
            <label>Kata Sandi</label>
            <input type="password" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn-pink" style="width: 100%; border-radius: 50px; padding: 0.75rem;">Login</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>