# Rancangan Fitur (Wireframe & User Flow) - SIMPUS-Mini

Dokumen ini berisi rancangan alur pengguna (*user flow*) dan tata letak (*wireframe*) berbasis teks untuk fitur-fitur yang akan dikembangkan pada bab selanjutnya.

---

## 1. Fitur Login

### User Flow
1. Pengguna membuka halaman Login.
2. Pengguna memasukkan **Username** dan **Password**.
3. Sistem memvalidasi akun:
   - **Valid:** Masuk ke Dashboard Petugas.
   - **Invalid:** Tampil pesan peringatan.

### Wireframe Teks
```text
+-------------------------------------------------------+
|                   SIMPUS-Mini                         |
|                                                       |
|                  +-----------------+                  |
|                  |   LOGIN SYSTEM  |                  |
|                  +-----------------+                  |
|                  | Username:       |                  |
|                  | [_____________] |                  |
|                  | Password:       |                  |
|                  | [_____________] |                  |
|                  |                 |                  |
|                  |  [ MASUK ]      |                  |
|                  +-----------------+                  |
|                                                       |
+-------------------------------------------------------+

+-------------------------------------------------------+
| [SIMPUS-Mini]  Beranda  Buku  Anggota  Transaksi  [X] |
+-------------------------------------------------------+
|  Dashboard Petugas                                    |
|                                                       |
|  +--------------+  +--------------+  +--------------+ |
|  | Total Buku   |  | Anggota      |  | Peminjaman   | |
|  |     120      |  |     45       |  |      8       | |
|  +--------------+  +--------------+  +--------------+ |
|                                                       |
|  Aksi Cepat:                                          |
|  [ + Pinjam Buku ]    [ + Kembalikan Buku ]           |
+-------------------------------------------------------+

+-------------------------------------------------------+
| [SIMPUS-Mini]  Beranda  Buku  Anggota  Transaksi  [X] |
+-------------------------------------------------------+
|  Form Transaksi Peminjaman                            |
|  -------------------------                            |
|  Pilih Anggota : [ Select Anggota          v ]        |
|  Pilih Buku    : [ Select Buku             v ]        |
|  Tgl Pinjam    : [ dd/mm/yyyy                ]        |
|  Tgl Kembali   : [ dd/mm/yyyy                ]        |
|                                                       |
|  [ SIMPAN PEMINJAMAN ]                                |
+-------------------------------------------------------+

+-------------------------------------------------------+
| [SIMPUS-Mini]  Beranda  Buku  Anggota  Transaksi  [X] |
+-------------------------------------------------------+
|  Form Pengembalian Buku                               |
|  -------------------------                            |
|  ID Transaksi  : [ TR-001                  ] [ CARI ] |
|  Nama Anggota  : Siti Aminah                          |
|  Judul Buku    : Laskar Pelangi                       |
|  Status Denda  : Terlambat 1 Hari (Rp 2.000)          |
|                                                       |
|  [ KONFIRMASI PENGEMBALIAN ]                          |
+-------------------------------------------------------+

+-------------------------------------------------------+
| [SIMPUS-Mini]  Beranda  Buku  Anggota  Transaksi  [X] |
+-------------------------------------------------------+
|  Riwayat Transaksi                                    |
|                                                       |
|  +----+----------+---------------+--------------+----+|
|  | ID | Anggota  | Buku          | Tgl Kembali  |Stts||
|  +----+----------+---------------+--------------+----+|
|  | 01 | Siti A.  | Laskar Pelangi| 05/09/2026   |LNS ||
|  | 02 | Budi S.  | Hujan         | 10/09/2026   |PJM ||
|  +----+----------+---------------+--------------+----+|
+-------------------------------------------------------+