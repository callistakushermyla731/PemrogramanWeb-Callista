# Jobsheet 9 - DIGIRENT

## Struktur CRUD

### Digicam
- `digicam/tambah.php` - form tambah
- `digicam/proses_tambah.php` - proses create
- `digicam/edit.php` - mengambil data berdasarkan id dan menampilkan form edit
- `digicam/proses_edit.php` - proses update
- `digicam/hapus.php` - proses delete dengan POST
- `digicam/list.php` - read, pencarian, dan pagination

### Pelanggan
- `pelanggan/tambah.php` - form tambah
- `pelanggan/proses_tambah.php` - proses create
- `pelanggan/edit.php` - mengambil data berdasarkan id dan menampilkan form edit
- `pelanggan/proses_edit.php` - proses update
- `pelanggan/hapus.php` - proses delete dengan POST
- `pelanggan/list.php` - read dan pagination

## Alur pengujian
1. Login sebagai admin.
2. Tambahkan data digicam/pelanggan.
3. Pastikan data tampil di list.
4. Klik Edit, ubah data, lalu simpan.
5. Pastikan data pada list berubah.
6. Klik Hapus.
7. Konfirmasi JavaScript muncul sebelum request dikirim.
8. Pastikan data hilang dari list.
9. Pada katalog digicam, gunakan pencarian nama.
10. Tambahkan lebih dari 10 data untuk menguji pagination.

## Catatan penyimpanan
Project ini menggunakan file JSON di folder `data/`, bukan PostgreSQL.
Karena itu pencarian server-side memakai filter PHP (`stripos`) sebagai padanan
pencarian nama, bukan SQL `ILIKE`.
