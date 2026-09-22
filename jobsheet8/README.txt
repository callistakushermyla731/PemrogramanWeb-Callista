# JOBSHEET 8

## Cara menjalankan
1. Install/jalankan XAMPP.
2. Start **Apache** dan **MySQL**.
3. Letakkan folder `jobsheet8` di:
   `C:\xampp\htdocs\`
4. Buka VS Code dan buka folder `jobsheet8`.
5. Jika memakai XAMPP, buka browser:
   `http://localhost/jobsheet8/`

### Kalau ingin menjalankan langsung dari VS Code
Pastikan PHP sudah terpasang dan perintah `php` bisa dipanggil dari terminal VS Code.

Di terminal VS Code, posisi harus berada di folder `jobsheet8`, lalu jalankan:
`php -S localhost:8000`

Kemudian buka:
`http://localhost:8000/`

Jangan buka:
`http://localhost:8000/jobsheet8/login.php`

Extension **PHP (DEVSENSE)** yang kamu pakai membantu coding/IntelliSense PHP, tetapi bukan web server. Server-nya dijalankan dengan perintah `php -S localhost:8000`.

## Login
- Username: `admindigirent123@gmail.com`
- Password: `12345678`

Setelah login:
- Header menampilkan `Hallo admindigirent123@gmail.com`
- Tombol Login berubah menjadi Logout
- Menu tambah/edit/hapus dapat digunakan
- Tombol Hapus hanya menghapus baris yang dipilih

## Database
`includes/koneksi.php` otomatis:
- membuat database `jobsheet8` jika belum ada
- membuat tabel `pelanggan`
- membuat tabel `diagram`
- memasukkan data contoh jika tabel masih kosong

Jika password MySQL root kamu tidak kosong, ubah `$pass` di `includes/koneksi.php`.
