<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
$folder = basename(dirname($_SERVER["SCRIPT_FILENAME"]));
$base = in_array($folder, ["diagram", "pelanggan"]) ? "../" : "";
?>
<header>
    <div class="header-container">
        <a href="<?= $base ?>index.php" class="brand-title">DIGIRENT</a>

        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="hamburger-btn">☰</label>

        <nav>
            <ul>
                <li><a href="<?= $base ?>index.php">Home</a></li>
                <li><a href="<?= $base ?>diagram/list.php">Diagram</a></li>
                <li><a href="<?= $base ?>pelanggan/list.php">Pelanggan</a></li>

                <?php if (isset($_SESSION["login"]) && $_SESSION["login"] === true): ?>
                    <li><a href="<?= $base ?>index.php" class="btn-login">Hallo <?= htmlspecialchars($_SESSION["email"]) ?></a></li>
                    <li><a href="<?= $base ?>logout.php" class="btn-login">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?= $base ?>login.php" class="btn-login">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
