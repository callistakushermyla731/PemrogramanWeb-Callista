<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Debug Session Data</title>
    <style>
        body { font-family: monospace; background: #1e1e1e; color: #00ff66; padding: 2rem; }
        h2 { color: #fff; border-bottom: 1px solid #444; padding-bottom: 0.5rem; }
        pre { background: #2d2d2d; padding: 1rem; border-radius: 8px; overflow-x: auto; }
        a { color: #00bcff; text-decoration: none; }
    </style>
</head>
<body>
    <h2>🔍 Debugging Isi $_SESSION Mentah</h2>
    <p><a href="index.php">&larr; Kembali ke Aplikasi</a></p>
    <pre><?php print_r($_SESSION); ?></pre>
</body>
</html>