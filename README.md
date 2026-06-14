<div align="center">
    <img src="public/logo.png" alt="Logo Bank Sampah" width="120" style="border-radius: 50%;">
    <h1>♻️ Sistem Informasi Bank Sampah</h1>
    <p>Aplikasi pengelolaan sampah berbasis web untuk mewujudkan lingkungan bersih dan ekonomi sirkular.</p>

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev/)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)

</div>

---

## 📖 Latar Belakang & Tujuan Aplikasi

**Bank Sampah** adalah platform digital yang dirancang untuk mendigitalisasi proses pengelolaan dan penyetoran sampah di tingkat masyarakat. 

**Tujuan Utama:**
1. **Meningkatkan Kesadaran Lingkungan:** Mengedukasi dan memotivasi masyarakat untuk memilah sampah dari rumah tangga.
2. **Ekonomi Sirkular:** Mengubah paradigma masyarakat dari "membuang sampah" menjadi "menabung sampah" yang memiliki nilai ekonomis.
3. **Digitalisasi Administrasi:** Menggantikan pencatatan manual di posko bank sampah desa/RT menjadi sistem yang terpusat, transparan, dan dapat dipantau *real-time*.

**Peran dalam Masyarakat:**
Jika diterapkan di lingkungan masyarakat (seperti tingkat RT/RW atau Desa), aplikasi ini akan berperan sebagai **jembatan antara warga dan pengepul/pengurus bank sampah**. Warga dapat dengan mudah melihat saldo yang terkumpul dari sampah yang mereka setorkan, dan menukarkannya (*redeem*) menjadi kebutuhan sehari-hari seperti Sembako, Pulsa, atau ditarik menjadi Uang Tunai. Hal ini akan memacu partisipasi aktif warga dalam menjaga kebersihan lingkungan karena adanya *reward* yang jelas dan transparan.

---

## ✨ Fitur Utama

### 👤 Fitur Warga (Pengguna)
- **Login Instan via Google:** Memudahkan warga yang awam teknologi untuk masuk ke dalam sistem hanya dengan satu klik (Google OAuth).
- **Dashboard Interaktif:** Menampilkan grafik setoran, total saldo yang dimiliki, dan riwayat transaksi secara *real-time*.
- **Katalog Penukaran (Reward):** Warga dapat menukarkan saldo sampah mereka dengan barang nyata (sembako, pulsa, token listrik, dll).
- **Tampilan Ramah Pengguna:** Desain *modern* (*Glassmorphism*) yang mendukung **Dark/Light Mode** serta ramah diakses dari HP (Responsif).

### 🛡️ Fitur Pengurus (Admin)
- **Dashboard Analitik Terpusat:** Pantauan total sampah yang masuk, total saldo yang dikeluarkan, serta status transaksi.
- **Manajemen Transaksi Warga:** Memvalidasi (Setujui/Tolak) setiap setoran sampah maupun permintaan penukaran hadiah dari warga.
- **Manajemen Katalog (CRUD):** Fleksibilitas untuk menambah, mengubah, atau menghapus daftar hadiah/sembako yang tersedia di sistem.

---

## 🛠️ Teknologi yang Digunakan

- **Backend:** [Laravel 11](https://laravel.com)
- **Frontend UI:** Blade Templates, [Tailwind CSS](https://tailwindcss.com) (Vanilla), Glassmorphism UI
- **Frontend Logic:** [Alpine.js](https://alpinejs.dev)
- **Database:** MySQL
- **Autentikasi:** Laravel Breeze, Laravel Socialite (Google Login Integration)

---

## 🚀 Panduan Instalasi (Untuk Developer/Dosen Penguji)

Untuk menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut:

### Persyaratan Sistem
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL (XAMPP/Laragon)

### Langkah Instalasi

1. **Clone repositori ini**
   ```bash
   git clone https://github.com/lukman123-creator/Bank_Sampah.git
   cd Bank_Sampah
   ```

2. **Install *dependencies* PHP**
   ```bash
   composer install
   ```

3. **Install *dependencies* NPM & *build asset***
   ```bash
   npm install
   npm run build
   ```

4. **Pengaturan *Environment***
   Salin file `.env.example` menjadi `.env`, lalu *generate* kunci aplikasi.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Pengaturan Database & Google OAuth**
   Buka file `.env` dan sesuaikan pengaturan *database*:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=bank_sampah_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   *(Pastikan Anda telah membuat database kosong bernama `bank_sampah_db` di MySQL).*

   *(Opsional)* Masukkan Kredensial Google OAuth untuk fitur Login Google:
   ```env
   GOOGLE_CLIENT_ID=client-id-anda.apps.googleusercontent.com
   GOOGLE_CLIENT_SECRET=client-secret-anda
   GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
   ```

6. **Migrasi Database dan *Seeding***
   Perintah ini akan membuat semua struktur tabel serta mengisi data awal (Akun Admin dan Katalog Hadiah default).
   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```
   Aplikasi siap diakses melalui browser di alamat `http://localhost:8000`.

---

## 🔑 Hak Akses (*Credentials*) Default

Setelah menjalankan perintah `migrate --seed`, Anda dapat menggunakan akun berikut untuk masuk ke Panel Admin:

- **Email:** `admin@banksampah.com`
- **Password:** `password`

*(Untuk mencoba fitur sebagai warga/masyarakat biasa, disarankan menggunakan fitur "Sign in with Google").*
