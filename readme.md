# Kelontong Store (My Store) - UTS Praktek Pemrograman Web 2

> Ganti semua bagian yang ada tanda `[ ... ]` dengan data kamu sendiri.

## Identitas
| | |
|---|---|
| Nama | [Mutiara Telaumbanua] |
| NIM | [25210018] |
| Program Studi | [Komputerisasi Akuntansi] |
| Kelas | [Group A] |
| Mata Kuliah | Praktek Pemrograman Web 2 |
| Dosen | [Prima Sitompul M.kom] |

## Deskripsi Project
Kelontong Store adalah aplikasi web toko kelontong berbasis PHP dan MySQL dengan struktur MVC dasar.
Pada UTS ini ditambahkan **Login Admin** dan **Dashboard Admin** untuk mengelola data produk (Create, Update, Delete).

## Fitur
- Login admin berbasis UI (password diverifikasi dengan BCRYPT)
- Halaman admin diproteksi: tanpa login otomatis diarahkan ke halaman login
- Dashboard: total produk, total stok, nilai stok, dan jumlah stok menipis
- **Create** produk baru
- **Update** produk yang sudah ada
- **Delete** produk yang tidak lagi diproduksi (discontinued)
- Pencarian produk langsung (JavaScript), konfirmasi hapus, dan pesan notifikasi
- Proteksi CSRF pada form dan logout
- 25 data produk dummy sesuai kebutuhan toko kelontong

## Teknologi
PHP 8, MySQL (PDO), HTML, CSS (custom), JavaScript, XAMPP, Git dan GitHub.

## Struktur Folder
```
Toko_kelontong/
├── app/ config/ views/          (aplikasi MVC)
├── database/dummy_produk.sql    (25 produk dummy)
├── public/
│   ├── admin/                   (login, dashboard, CRUD produk)
│   ├── css/admin.css
│   └── js/admin.js
├── screenshoot/                 (bukti hasil pekerjaan)
└── readme.md
```

## Cara Menjalankan
1. Pasang XAMPP, lalu Start **Apache** dan **MySQL**.
2. Salin folder project ke `C:\xampp\htdocs\Toko_kelontong`.
3. Buka phpMyAdmin, buat database `mvc_mystore`, lalu impor file SQL tabel (`users`, `products`).
4. Jalankan `database/dummy_produk.sql` untuk mengisi data produk dummy.
5. Buka `http://localhost/Toko_kelontong/public/admin/login.php`

## Akun Admin
| Username | Password |
|---|---|
| admin | admin123 |

## Daftar Screenshoot
| File | Keterangan |
|---|---|
| `screenshoot/01_login.png` | Halaman Login Admin |
| `screenshoot/02_dashboard.png` | Dashboard Admin |
| `screenshoot/03_daftar_produk.png` | Daftar 25+ produk |
| `screenshoot/04_create_produk.png` | Tambah produk baru |
| `screenshoot/05_update_produk.png` | Update produk |
| `screenshoot/06_delete_produk.png` | Hapus produk |
| `screenshoot/07_phpmyadmin.png` | Tabel products di phpMyAdmin |

## Link Repository
[https://github.com/USERNAME/uts-PRODI-NAMA]
