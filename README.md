# Aplikasi Presensi Siswa

## Tentang Aplikasi

Aplikasi Presensi Siswa adalah website untuk mengelola data kelas, data siswa, dan mencatat kehadiran siswa melalui simulasi tap kartu menggunakan NISN. Website dibuat menggunakan PHP Native dengan konsep OOP dan database MariaDB.

## Fitur yang Dibuat

- **Login dan logout:** admin masuk dan keluar dari aplikasi.
- **Data kelas:** menampilkan, menambah, mengubah, dan menghapus kelas. Kelas yang masih mempunyai siswa tidak dapat dihapus.
- **Data siswa:** menampilkan, menambah, mengubah, menghapus, dan mencari siswa menggunakan nama atau NISN.
- **Tap kartu:** memasukkan NISN untuk mencatat kehadiran siswa.
- **Rekap presensi:** melihat catatan kehadiran, melakukan pencarian dan filter, serta menghapus log presensi.

## Struktur Folder Project

```text
presensi siswa/
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       ├── script.js
│       └── liquid-glass.js
├── config/
│   └── Database.php
├── includes/
│   ├── auth.php
│   ├── header.php
│   ├── navbar.php
│   └── footer.php
├── models/
│   ├── BaseModel.php
│   ├── Kelas.php
│   ├── Siswa.php
│   └── Presensi.php
├── kelas/
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
├── siswa/
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
├── presensi/
│   ├── index.php
│   ├── tap.php
│   └── hapus.php
├── index.php
├── login.php
├── logout.php
├── schema.sql
├── seed_admin.php
├── tes_koneksi.php
├── tes_oop.php
└── README.md
```

Struktur di atas menunjukkan letak file utama aplikasi. Setiap folder memisahkan tugas supaya program lebih mudah dicari dan diperbaiki.

## Penjelasan Folder dan File

### File di Folder Utama

- `index.php` — halaman dashboard atau halaman utama setelah admin masuk.
- `login.php` — halaman untuk memasukkan username dan password admin. Setelah login berhasil, pengguna diarahkan ke halaman aplikasi sesuai pengaturan pada kode login.
- `logout.php` — mengakhiri sesi login lalu mengarahkan pengguna kembali ke halaman login.
- `schema.sql` — perintah SQL untuk membuat struktur database dan tabel yang digunakan aplikasi.
- `seed_admin.php` — digunakan untuk membuat akun admin awal.
- `tes_koneksi.php` — file untuk mencoba apakah koneksi PHP ke database berjalan.
- `tes_oop.php` — file untuk mencoba penerapan class dan konsep OOP.
- `README.md` — berisi penjelasan project dan kegunaan file-file di dalamnya.

### Folder `assets`

Folder ini menyimpan file tampilan website.

- `assets/css/style.css` — mengatur tampilan bergaya iOS Liquid Glass, seperti kaca transparan, efek blur, pantulan cahaya, tombol membulat, animasi, serta tampilan yang menyesuaikan layar HP.
- `assets/js/script.js` — berisi JavaScript untuk interaksi pada website.
- `assets/js/liquid-glass.js` — memberikan efek cahaya yang mengikuti kursor dan efek saat tombol atau menu navigasi ditekan dan ditahan. Efek ini hanya mengubah tampilan, bukan proses data PHP.

### Folder `config`

- `config/Database.php` — mengatur koneksi ke database menggunakan PDO. Koneksi ini dipakai oleh model untuk menjalankan query.

### Folder `includes`

Folder ini menyimpan bagian yang digunakan berulang di beberapa halaman.

- `includes/auth.php` — memeriksa sesi login agar halaman khusus admin tidak dibuka sembarangan.
- `includes/header.php` — bagian awal tampilan halaman, termasuk pemanggilan CSS.
- `includes/navbar.php` — menu navigasi untuk berpindah ke dashboard, kelas, siswa, tap kartu, dan rekap presensi.
- `includes/footer.php` — bagian penutup tampilan halaman. File ini juga memanggil `assets/js/liquid-glass.js` agar efek interaktif aktif di halaman yang memakai footer.

### Folder `models`

Folder ini berisi class PHP yang mengurus proses dan data aplikasi.

- `models/BaseModel.php` — class dasar yang menyiapkan koneksi database untuk model lainnya.
- `models/Kelas.php` — mengurus data kelas di database, seperti mengambil, menambah, mengubah, dan menghapus kelas.
- `models/Siswa.php` — mengurus data siswa, termasuk pencarian berdasarkan nama atau NISN.
- `models/Presensi.php` — mengurus pencatatan tap kartu dan data rekap presensi.

### Folder `kelas`

- `kelas/index.php` — menampilkan daftar kelas.
- `kelas/tambah.php` — formulir untuk menambahkan kelas.
- `kelas/edit.php` — formulir untuk mengubah data kelas.
- `kelas/hapus.php` — memproses penghapusan kelas, dengan pembatasan jika kelas masih memiliki siswa.

Halaman dalam folder `kelas` menggunakan class `models/Kelas.php` untuk mengolah data kelas.

### Folder `siswa`

- `siswa/index.php` — menampilkan daftar siswa dan kolom pencarian nama atau NISN.
- `siswa/tambah.php` — formulir untuk menambahkan siswa baru.
- `siswa/edit.php` — formulir untuk mengubah data siswa.
- `siswa/hapus.php` — memproses penghapusan siswa.

Halaman dalam folder `siswa` menggunakan `models/Siswa.php`. Formulir siswa juga membutuhkan data kelas agar siswa dapat ditempatkan pada kelas yang sesuai.

### Folder `presensi`

- `presensi/index.php` — menampilkan rekap presensi dan menyediakan pencarian atau filter.
- `presensi/tap.php` — formulir simulasi tap kartu dengan memasukkan NISN siswa.
- `presensi/hapus.php` — memproses penghapusan catatan presensi.

Halaman dalam folder `presensi` menggunakan `models/Presensi.php` untuk mengakses data presensi.

## Tampilan iOS Liquid Glass

Tampilan website menggunakan gaya iOS dengan efek kaca transparan (*Liquid Glass*). Efeknya dibuat menggunakan CSS dan JavaScript, bukan fitur asli sistem operasi iOS.

- **Kaca transparan:** navbar, formulir, tabel, dan footer terlihat seperti lapisan kaca dengan efek blur.
- **Efek cahaya:** pantulan pada tombol dan menu mengikuti posisi kursor.
- **Tekan dan tahan:** tombol dan menu memberikan animasi saat ditekan.
- **Animasi halus:** perpindahan efek terasa lebih lembut.
- **Responsif:** tampilan menyesuaikan ukuran layar komputer dan HP.

`style.css` mengatur bentuk dan animasinya, sedangkan `liquid-glass.js` menangani interaksi saat pengguna menggerakkan kursor atau menekan tombol. File JavaScript tersebut dipanggil melalui `includes/footer.php`.

## Alur Kerja Aplikasi

1. Admin membuka `login.php` dan memasukkan username serta password.
2. Setelah berhasil masuk, admin menggunakan menu navigasi untuk membuka fitur yang dibutuhkan.
3. Admin mengisi data kelas melalui halaman pada folder `kelas`.
4. Admin mengisi data siswa melalui halaman pada folder `siswa`. Setiap siswa terhubung dengan kelas.
5. Saat melakukan simulasi tap kartu, admin membuka `presensi/tap.php` dan memasukkan NISN.
6. `presensi/tap.php` meminta `models/Presensi.php` memproses NISN dan menyimpan presensi jika valid.
7. Catatan kehadiran dapat dilihat melalui `presensi/index.php`.
8. Setelah selesai, admin memilih logout untuk mengakhiri sesi.

## Hubungan dengan Database

Database aplikasi terdiri dari empat tabel utama:

- `users` — menyimpan akun admin.
- `kelas` — menyimpan nama kelas dan jurusan.
- `siswa` — menyimpan NISN, nama, alamat, dan kelas siswa.
- `presensi` — menyimpan NISN serta tanggal dan waktu kehadiran.

Satu kelas dapat mempunyai banyak siswa. Satu siswa juga dapat mempunyai banyak catatan presensi. Hubungan ini dijaga menggunakan foreign key pada database.

## Teknologi

PHP Native (OOP), MariaDB/MySQL, PDO, HTML, CSS (Liquid Glass), JavaScript, dan Laragon.

## Kegunaan Website

Website ini digunakan untuk membantu admin menyimpan dan mengatur data kelas serta siswa. Admin juga bisa mencatat kehadiran menggunakan NISN, mencari siswa dengan cepat, dan melihat kembali hasil presensi berdasarkan data yang tersimpan.

## Kesimpulan

Aplikasi Presensi Siswa memudahkan pengelolaan data siswa, kelas, dan kehadiran dalam satu website. Simulasi tap kartu memakai NISN, sehingga presensi dapat dicatat dan dilihat kembali melalui halaman rekap. Pembagian file ke dalam beberapa folder juga membuat program lebih rapi dan mudah dipahami.
