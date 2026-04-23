# Aplikasi Manajemen Buku Perpustakaan

## Identitas Mahasiswa
- Nama: Januar Putra Wicaksana
- NIM: 220103061
- Kelas: UJK Kelompok 3

## Tema Kasus
Tema kasus yang digunakan adalah **manajemen buku perpustakaan**. Aplikasi ini dirancang untuk membantu pengguna melakukan login ke sistem dan mengelola data buku melalui fitur CRUD.

## Arsitektur Aplikasi
Aplikasi dibangun menggunakan:
- **Backend**: PHP Native
- **Database**: MySQL
- **Frontend**: HTML, CSS, Bootstrap 5
- **Autentikasi**: Session PHP
- **Keamanan Password**: `password_hash()` dan `password_verify()`

## Struktur Database
Aplikasi menggunakan minimal 2 tabel utama:
1. **users**
   - Menyimpan data akun pengguna untuk proses login.
   - Field utama: `id`, `name`, `email`, `password`, `created_at`.
2. **books**
   - Menyimpan data bisnis berupa informasi buku.
   - Field utama: `id`, `title`, `author`, `publisher`, `year_published`, `stock`, `created_at`.

## Fitur Utama
- Login pengguna
- Register pengguna
- Password terenkripsi
- Session login
- Proteksi halaman CRUD setelah login
- Menampilkan data buku
- Menambah data buku
- Mengubah data buku
- Menghapus data buku
- Logout
- Dashboard sederhana dengan statistik total buku dan stok
