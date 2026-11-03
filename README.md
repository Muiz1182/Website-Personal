# MMA PRODUCTION &bull; Personal Portfolio &amp; CMS

Website portofolio profesional dan Content Management System (CMS) untuk **Mochammad Muiz Afdloly**, dirancang khusus untuk memamerkan karya dan layanan pada 3 pilar keahlian utama:
1. **Videography**: Video Cinematic &amp; Video Podcast berstandar studio.
2. **Designer**: Desain antarmuka UI/UX (Figma), ilustrasi digital kustom, dan poster komersial/acara.
3. **Web Developer**: Pengembangan aplikasi web full-stack menggunakan Laravel, Vue.js, PHP, dan JavaScript.

---

## Fitur Utama

- **3D Interactive Lanyard Pass (Hero Section)**:
  - Kartu tanda pengenal interaktif berbasis Three.js &amp; WebGL dengan simulasi fisika dinamis (dapat ditarik, diayunkan, dan berputar).
  - Tekstur kartu depan dapat diganti secara langsung melalui Panel Admin (mendukung foto potret, kartu ID, atau grafis kustom).
- **Panel Admin CMS Terintegrasi (`/admin/login`)**:
  - **Karya Portofolio (Selected Works)**: Tambah, edit, dan hapus proyek portofolio, atur kategori (Videography, Design, Web Developer), upload gambar, serta konfigurasi rasio dan ukuran grid.
  - **Pilar Keahlian (Capabilities)**: Kelola judul layanan, tagline, deskripsi, dan butir-butir berkas luaran (*deliverables*).
  - **Profil Kreator**: Perbarui bio, peran profesional, foto profil, dan foto kartu lanyard 3D.
  - **Ulasan Klien**: Tambah, edit, dan kelola testimoni klien. Bagian ini otomatis menyesuaikan tampilan jika data kosong.
- **Dukungan Bilingual (ID &bull; EN)**:
  - Sistem pengalih bahasa instan (Bahasa Indonesia &bull; English) dengan penyimpanan preferensi di sesi browser.
- **Formulir Pengajuan Proyek &amp; Notifikasi Email**:
  - Formulir brief komisi proyek dengan validasi lengkap dan perlindungan spam rate-limiting.
  - Terintegrasi langsung dengan pengiriman email SMTP Gmail secara *real-time*.
- **Desain &bull; Estetika Sinematik Modern**:
  - Tema gelap (*dark mode*) elegan dengan palet warna hitam pekat (`#070707`), kartu gelap (`#0E0E10`), aksen oranye sinematik (`#FF5722`), serta kepatuhan standar aksesibilitas kontras WCAG AA.

---

## Teknologi yang Digunakan

- **Backend**:
  - PHP 8.2+
  - Laravel 11 Framework
  - MySQL / MariaDB Database
- **Frontend**:
  - Tailwind CSS 3
  - Alpine.js (State management reaktif ringan)
  - Three.js (Render kartu 3D lanyard &amp; simulasi fisika)
  - Vite (Asset bundler modern)

---

## Panduan Instalasi Lokal

### 1. Kebutuhan Sistem
Pastikan perangkat Anda telah terinstal:
- PHP >= 8.2
- Composer
- Node.js &amp; NPM
- MySQL / MariaDB (misalnya via XAMPP atau Laragon)
- Git

### 2. Kloning Repositori
```bash
git clone https://github.com/Muiz1182/Website-Personal.git
cd Website-Personal
```

### 3. Instal Dependensi PHP &amp; Node
```bash
composer install
npm install
```

### 4. Konfigurasi Lingkungan (.env)
Salin berkas konfigurasi `.env.example` menjadi `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

Sesuaikan parameter basis data di berkas `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mma_db
DB_USERNAME=root
DB_PASSWORD=
```

Konfigurasi pengiriman email formulir (menggunakan sandi aplikasi Google):
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=muiz1182.business@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="muiz1182.business@gmail.com"
MAIL_FROM_NAME="MMA PRODUCTION"
```

### 5. Migrasi &amp; Seeding Database
Jalankan migrasi tabel CMS dan *seeder* data awal:
```bash
php artisan migrate --seed --class=AdminCmsSeeder
```

*Data bawaan admin yang dibuat oleh seeder:*
- **Email**: `admin@mmaproduction.com`
- **Password**: `admin1182`

### 6. Kompilasi Aset Frontend
```bash
npm run build
```

### 7. Jalankan Server Lokal
```bash
php artisan serve --port=8000
```
Buka browser dan akses:
- **Website Utama**: `http://localhost:8000`
- **Panel Admin CMS**: `http://localhost:8000/admin/login`

---

## Struktur Direktori Utama

```
mma-production/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/               # Kontroler CRUD Panel Admin
│   │   ├── ContactController.php # Penanganan brief formulir kontak
│   │   └── LandingController.php # Penanganan halaman depan bilingual
│   ├── Mail/                    # Mailable notifikasi email pengajuan proyek
│   └── Models/                  # Eloquent models (Project, Service, CreatorProfile, Testimonial, User)
├── database/
│   ├── migrations/              # Skema tabel database MySQL
│   └── seeders/                 # Seeder admin &amp; data awal konten
├── public/
│   ├── images/                  # Aset SVG &amp; grafis default lanyard
│   └── uploads/                 # Berkas upload gambar proyek &amp; profil kreator
├── resources/
│   ├── css/                     # Konfigurasi Tailwind &amp; styling canvas
│   ├── js/                      # Script interaktif (lanyard 3D, tech-text, dll.)
│   └── views/
│       ├── admin/               # Blade templates panel admin
│       ├── components/          # Komponen Blade (Navbar, Footer, Hero, Works, dll.)
│       └── welcome.blade.php    # Halaman utama portofolio
└── routes/
    ├── web.php                  # Rute website &amp; panel admin
    └── console.php              # Perintah artisan konsol kustom
```

---

## Lisensi &bull; Hak Cipta

&copy; {{ date('Y') }} **MMA PRODUCTION &bull; Mochammad Muiz Afdloly**. Hak Cipta Dilindungi.
Dilisensikan di bawah [MIT License](LICENSE).
