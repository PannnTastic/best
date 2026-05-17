# Deployment Guide - BEST Clientside

Deploy ke cPanel melalui GitHub.

## 1. Setup Repository di GitHub

Pastikan repo sudah di-push ke GitHub:
```bash
git add .
git commit -m "chore: prepare production deploy"
git push origin main
```

## 2. Setup cPanel

### A. Git Clone / Git Version Control (cPanel)
1. Login cPanel → **Git Version Control**
2. Klik **Create** → Masukkan URL repo GitHub (`https://github.com/username/best.git`)
3. Pilih branch `main`
4. Clone ke folder (contoh: `~/best` atau `~/public_html/best`)

### B. Atur Document Root ke `public/`
1. cPanel → **Domains** / **Addon Domains**
2. Document root arahkan ke folder `public/` dalam project, contoh:
   - `/home/username/public_html` → symlink atau arahkan ke `~/best/public`
   - Atau jika pakai subdomain: Document root = `~/best/public`

### C. Copy Environment File
```bash
cd ~/best
cp .env.example .env
nano .env
```
Ubah konfigurasi penting:
- `APP_URL=https://domain-anda.com`
- `DB_DATABASE=best`
- `DB_USERNAME=...`
- `DB_PASSWORD=...`
- `APP_KEY=` → generate dengan: `php artisan key:generate`

### D. Jalankan Deploy Script
```bash
cd ~/best
bash deploy.sh
```

## 3. Build Assets (Pilih salah satu)

### Opsi A: Build di lokal lalu push ke GitHub (Rekomendasi untuk cPanel tanpa Node.js)
```bash
# Di lokal (Windows)
npm install
npm run build
git add public/build -f
git commit -m "build: production assets"
git push origin main
```
Kemudian di cPanel cukup `git pull` saja (deploy.sh akan skip npm build jika `public/build` sudah ada).

### Opsi B: Build di cPanel (jika cPanel punya Node.js / SSH access)
Jalankan `deploy.sh` — sudah include `npm ci && npm run build`.

## 4. Jalankan Deploy Manual (jika tidak pakai deploy.sh)
```bash
cd ~/best
php /usr/local/bin/composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 5. Fix Permission (jika diperlukan)
```bash
chmod -R 755 storage bootstrap/cache
chmod -R 755 public
```

## 6. Shared Storage dengan CMS (cmsbest)

Jika CMS (`cmsbest`) ada di server yang sama:
```bash
cd ~/best/public
rm -rf storage
ln -s ~/cmsbest/storage/app/public storage
```
Atau jika beda server, pastikan CMS upload ke shared disk/S3.
