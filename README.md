# MMA PRODUCTION &bull; Personal Portfolio Website

Website portofolio profesional berkinerja tinggi untuk **Mochammad Muiz Afdloly**, dirancang khusus untuk memamerkan karya terkurasi dan layanan terintegrasi pada 3 pilar keahlian utama:
1. **Videography**: Video Cinematic &amp; Video Podcast berstandar studio.
2. **Designer**: Desain antarmuka UI/UX (Figma), ilustrasi digital kustom, dan poster komersial/acara.
3. **Web Developer**: Pengembangan aplikasi web modern menggunakan Laravel, Vue.js, PHP, dan JavaScript.

---

## Fitur Utama

- **3D Interactive Lanyard Pass (Hero Section)**:
  - Kartu tanda pengenal interaktif berbasis Three.js &amp; WebGL dengan simulasi fisika dinamis (dapat ditarik, diayunkan, dan berputar secara interaktif).
  - Tampilan visual kartu depan beresolusi tinggi dengan tipografi tajam.
- **Kurasi Portofolio 3 Pilar Keahlian**:
  - Filter kategori instan tanpa *reload* (Videography, Design, Web Developer).
  - Tata letak asimetris dinamis dengan rasio visual sinematik.
  - Modal detail interaktif untuk melihat ikhtisar proyek dan spesifikasi alat teknis.
- **Dukungan Bilingual Penuh (ID &bull; EN)**:
  - Sistem pengalih bahasa instan (Bahasa Indonesia &bull; English) dengan penyimpanan preferensi sesi secara otomatis.
- **Formulir Pengajuan Proyek**:
  - Formulir brief kebutuhan proyek terstruktur dengan proteksi validasi ketat dan *rate-limiting*.
  - Terhubung langsung dengan sistem notifikasi pengiriman pesan otomatis.
- **Desain &bull; Estetika Sinematik Modern**:
  - Tema gelap (*dark mode*) elegan dengan palet warna hitam pekat (`#070707`), kartu gelap (`#0E0E10`), serta aksen oranye sinematik (`#FF5722`).
  - Memenuhi standar aksesibilitas kontras teks WCAG AA untuk keterbacaan optimal.

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

### 3. Instal Dependensi
```bash
composer install
npm install
```

### 4. Konfigurasi Lingkungan (.env)
Salin berkas konfigurasi template `.env.example` menjadi `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

Sesuaikan parameter koneksi basis data di berkas `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mma_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi Database
Jalankan migrasi skema tabel database:
```bash
php artisan migrate
```

### 6. Kompilasi Aset Frontend
```bash
npm run build
```

### 7. Jalankan Server Lokal
```bash
php artisan serve --port=8000
```
Buka browser dan akses alamat:
`http://localhost:8000`

---

## Struktur Direktori Utama

```
mma-production/
├── app/
│   ├── Http/Controllers/
│   │   ├── ContactController.php # Penanganan formulir pengajuan proyek
│   │   └── LandingController.php # Logika tampilan portofolio bilingual
│   ├── Mail/                    # Mailable notifikasi proyek
│   └── Models/                  # Eloquent models
├── database/
│   └── migrations/              # Skema tabel database
├── public/
│   ├── images/                  # Aset grafis visual
│   └── uploads/                 # Berkas visual karya &amp; profil
├── resources/
│   ├── css/                     # Styling Tailwind &amp; canvas
│   ├── js/                      # Script interaktif (lanyard 3D, tech-text)
│   └── views/
│       ├── components/          # Komponen Blade modular (Navbar, Footer, Hero, dll.)
│       └── welcome.blade.php    # Tampilan utama portofolio
└── routes/
    └── web.php                  # Rute website aplikasi
```

---

## Lisensi &bull; Hak Cipta

&copy; {{ date('Y') }} **MMA PRODUCTION &bull; Mochammad Muiz Afdloly**. Hak Cipta Dilindungi.
Dilisensikan di bawah [MIT License](LICENSE).
