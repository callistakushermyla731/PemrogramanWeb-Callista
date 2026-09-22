<?php
$depth = 0;
include 'includes/header.php';
?>

<div class="form-card" style="max-width: 400px; margin-top: 2rem;">
    <div style="text-align: center; margin-bottom: 1.5rem;">
        <h2 style="color: #d63384;">Login Administrator</h2>
        <p style="color: #666; font-size: 0.85rem; margin-top: 0.3rem;">Silakan masuk ke akun DIGIRENT kamu</p>
    </div>

    <form action="proses_login.php" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" class="btn-pink" style="width: 100%; margin-top: 0.8rem;">Masuk</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>