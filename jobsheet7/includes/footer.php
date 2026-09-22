</main>

    <footer style="text-align: center; padding: 1.5rem; margin-top: auto; border-top: 1px solid #eee;">
        <p>&copy; 2026 <strong>DIGIRENT</strong> &mdash; System Management Rental Digicam (PHP Jobsheet 7)</p>
        
        <!-- Fitur Latihan 7.4: Reset Session & Debug -->
        <div style="margin-top: 0.8rem; font-size: 0.8rem;">
            <a href="<?= $base ?>reset_session.php" onclick="return confirm('Apakah Anda yakin ingin mereset seluruh data session ke semula?')" style="color: #dc3545; text-decoration: none; margin-right: 15px;">🔄 Reset Data Session</a>
            <a href="<?= $base ?>debug_session.php" target="_blank" style="color: #0d6efd; text-decoration: none;">🔍 Debug Session Data</a>
        </div>
    </footer>
</body>
</html>