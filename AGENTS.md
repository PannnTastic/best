# AGENTS.md - PT Berkah Sekawan Tangguh (BEST)

## Tentang Proyek
Proyek ini adalah website e-commerce untuk **PT Berkah Sekawan Tangguh (BEST)**, sebuah perusahaan yang menyediakan material bangunan/solusi konstruksi.

## Tech Stack
- **Framework**: Laravel 11
- **Styling**: Tailwind CSS
- **Build Tool**: Vite
- **Font**: Inter (Google Fonts)

## Struktur Direktori Penting
```
resources/views/
├── layouts/
│   └── app.blade.php          # Layout utama dengan header dan footer
├── home.blade.php             # Halaman beranda
├── products/
│   ├── index.blade.php        # Halaman list produk
│   └── detail.blade.php       # Halaman detail produk
├── blogs/
│   ├── index.blade.php        # Halaman list blog
│   └── detail.blade.php       # Halaman detail blog
└── cart/
    └── index.blade.php        # Halaman keranjang

public/images/                 # Asset gambar
├── logo-best.png              # Logo utama (warna)
└── logo-best-white.png        # Logo putih (untuk footer)
```

## Warna Brand
- **Primary Blue**: `#0F3075` - Warna utama biru tua
- **Accent Orange**: `#F97316` - Warna aksen/orange
- **Orange Gradient**: `#FB923C` ke `#F97316` - Gradient untuk cards
- **Background**: `#F9FAFB` - Abu-abu terang
- **Text Primary**: `#1E293B` (slate-900)
- **Text Secondary**: `#6B7280` (gray-500)

## Komponen UI

### Header
- Logo di sebelah kiri
- Navigasi: HOME, PRODUK, BLOG, CONTACT US
- Active state: Background biru dengan text putih rounded
- Icon cart dan user di kanan

### Footer
- Background: `#0F3075` (biru tua)
- Logo putih
- 4 kolom: Brand/Deskripsi, Navigasi, Akses Cepat, Kontak
- Social media icons (orange)
- Copyright PT. Berkah Sekawan Tangguh

### Cards Produk
- Rounded-lg shadow-sm
- Hover: shadow-md dengan scale gambar
- Rating bintang orange
- Harga bold blue

## Route yang Tersedia
- `/` - Home
- `/products` - List produk
- `/products/{id}` - Detail produk
- `/blog` - List blog
- `/blog/{id}` - Detail blog
- `/cart` - Keranjang belanja
- `/brosur` - Halaman brosur

## Integrasi dengan CMS (`cmsbest`)
- **CMS**: Laravel 11 + Filament v3 (folder `../cmsbest/`)
- **Database**: Shared MySQL (`DB_DATABASE=best`). CMS mengelola data master, client-side menampilkan data yang sama.
- **Upload Storage**: CMS menyimpan gambar di `storage/app/public/` (disk `public`). Client-side mengakses via symlink `public/storage/` menggunakan `asset('storage/' . $path_gambar)`.
- **Field Mapping** (pastikan konsisten):
  - Category: `nama_kategori`
  - Product Picture: `path_gambar`
  - Blog Image: `gambar_blog`
  - Blog PDF: `pdf_blog`

## Catatan untuk Development
1. Selalu gunakan `asset()` untuk referensi gambar/logo
2. Gunakan color palette yang sudah ditentukan
3. Pastikan responsive (mobile-first)
4. Active state navigasi menggunakan kondisi `request()->routeIs()`
5. Logo header menggunakan logo warna, footer menggunakan logo putih
6. Pastikan symlink `public/storage` sudah dibuat (`php artisan storage:link`)

## Assets Gambar
Logo tersedia di root folder:
- `LOGO BEST 2 (PRIMARY) 1.png` -> `public/images/logo-best.png`
- `BEST White@4x 1.png` -> `public/images/logo-best-white.png`

## Production Deployment (cPanel + GitHub)
- Lihat `DEPLOY.md` untuk panduan lengkap deploy ke cPanel
- `.env.example` sudah dikonfigurasi untuk production (MySQL, APP_DEBUG=false)
- `deploy.sh` tersedia untuk menjalankan deploy otomatis di cPanel
- Build assets (Vite): jalankan `npm run build` lalu push `public/build/` ke GitHub, atau build langsung di server jika tersedia Node.js
- Pastikan symlink `public/storage` mengarah ke `cmsbest/storage/app/public` untuk shared upload
