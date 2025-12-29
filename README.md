# Sistem Pendukung Keputusan Pemilihan Lagu Berdasarkan Emosi (Metode SAW)

Website ini adalah aplikasi Sistem Pendukung Keputusan (SPK) untuk merekomendasikan lagu berdasarkan emosi pendengar menggunakan metode Simple Additive Weighting (SAW).

## Fitur Utama
- **CRUD Kriteria**: Tambah, edit, hapus, dan lihat daftar kriteria penilaian lagu.
- **CRUD Alternatif**: Tambah, edit, hapus, dan lihat daftar lagu beserta nilai tiap kriteria.
- **CRUD Bobot Emosi**: Kelola bobot/emosi (Happy, Sad, Relax, Energetic) beserta bobot tiap kriteria.
- **Proses SAW**: Satu tombol untuk melakukan normalisasi dan perangkingan otomatis.
- **Halaman Rekomendasi**: User memilih emosi, sistem menampilkan rekomendasi lagu terbaik sesuai emosi.
- **Dashboard Statistik**: Menampilkan jumlah kriteria, alternatif, bobot, dan user admin.
- **UI Modern**: Menggunakan Tailwind CSS, responsif, dan interaktif.

## Struktur Folder
- `admin/` : Halaman admin (dashboard, CRUD, proses SAW, rekomendasi)
- `config/` : Koneksi database
- `models/` : Model PHP untuk akses data
- `controllers/` : Controller untuk logika CRUD
- `views/` : Tampilan (alternatif, bobot, kriteria)
- `index.php` : Halaman utama rekomendasi untuk user

## Cara Install & Menjalankan
1. **Clone/download** project ke folder web server (misal: `htdocs/spk` di XAMPP).
2. Import file `spk.sql` ke database MySQL/MariaDB Anda.
3. Edit `config/database.php` jika perlu menyesuaikan koneksi database.
4. Jalankan XAMPP/Laragon, buka browser ke `http://localhost/spk/` untuk halaman rekomendasi user.
5. Untuk admin, akses `http://localhost/spk/admin/` (login default: admin/admin).

## Alur Penggunaan
1. **Admin** login, kelola kriteria, alternatif lagu, dan bobot emosi.
2. **User** memilih emosi pada halaman utama, sistem menampilkan rekomendasi lagu terbaik.
3. Proses perhitungan SAW dilakukan otomatis saat user memilih emosi.

## Teknologi
- PHP 7/8
- MySQL/MariaDB
- Tailwind CSS
- HTML5

## Metode SAW
1. **Normalisasi**: Setiap nilai kriteria dinormalisasi berdasarkan nilai maksimum.
2. **Perangkingan**: Nilai normalisasi dikalikan bobot, dijumlahkan untuk mendapatkan skor akhir.
3. **Rekomendasi**: Lagu dengan skor tertinggi menjadi rekomendasi utama.

## Kontribusi & Lisensi
- Silakan modifikasi, gunakan, dan kembangkan sesuai kebutuhan.
- Untuk kontribusi, buat pull request atau issue.

---

**Dibuat untuk tugas/skripsi, pembelajaran, atau referensi SPK berbasis web.**
