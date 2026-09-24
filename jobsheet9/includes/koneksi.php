<?php
/*
 * Penyimpanan data lokal - tidak membutuhkan XAMPP, MySQL, atau database server.
 * Data disimpan di folder data dalam format JSON.
 */

$data_dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data';

if (!is_dir($data_dir)) {
    mkdir($data_dir, 0777, true);
}

function file_data_path($nama_file) {
    global $data_dir;
    return $data_dir . DIRECTORY_SEPARATOR . $nama_file . '.json';
}

function baca_data($nama_file, $data_awal = []) {
    $path = file_data_path($nama_file);

    if (!file_exists($path)) {
        simpan_data($nama_file, $data_awal);
        return $data_awal;
    }

    $isi = file_get_contents($path);
    $data = json_decode($isi, true);

    return is_array($data) ? $data : $data_awal;
}

function simpan_data($nama_file, $data) {
    $path = file_data_path($nama_file);
    $hasil = file_put_contents(
        $path,
        json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        LOCK_EX
    );

    return $hasil !== false;
}

function cari_data($nama_file, $id) {
    $data = baca_data($nama_file);

    foreach ($data as $row) {
        if ((int)$row['id'] === (int)$id) {
            return $row;
        }
    }

    return null;
}

function id_baru($data) {
    if (empty($data)) {
        return 1;
    }

    $ids = array_column($data, 'id');
    return max(array_map('intval', $ids)) + 1;
}

// Data awal dibuat otomatis saat pertama kali halaman dibuka.
baca_data('digicam', [
    [
        'id' => 1,
        'nama' => 'Canon IXUS 185',
        'merek' => 'Canon',
        'tipe' => 'Compact Camera',
        'harga_sewa' => 75000,
        'stok' => 3
    ],
    [
        'id' => 2,
        'nama' => 'Sony Cyber-shot DSC-W830',
        'merek' => 'Sony',
        'tipe' => 'Compact Camera',
        'harga_sewa' => 80000,
        'stok' => 2
    ],
    [
        'id' => 3,
        'nama' => 'Fujifilm FinePix JX500',
        'merek' => 'Fujifilm',
        'tipe' => 'Compact Camera',
        'harga_sewa' => 70000,
        'stok' => 4
    ]
]);

baca_data('pelanggan', [
    [
        'id' => 1,
        'nama' => 'Callista',
        'email' => 'callista@gmail.com',
        'no_hp' => '081234567890',
        'alamat' => 'Malang'
    ],
    [
        'id' => 2,
        'nama' => 'Dimas',
        'email' => 'dimas@gmail.com',
        'no_hp' => '082345678901',
        'alamat' => 'Blitar'
    ]
]);

baca_data('diagram', [
    [
        'id' => 1,
        'nama' => 'Diagram Data Pelanggan',
        'keterangan' => 'Menampilkan data pelanggan yang tersimpan.'
    ],
    [
        'id' => 2,
        'nama' => 'Diagram Penjualan',
        'keterangan' => 'Menampilkan informasi penjualan.'
    ]
]);
?>
