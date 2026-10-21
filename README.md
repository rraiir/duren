# DuREN

Web penjualan durian utuh dengan manajemen stok ready dan pre-order, pembayaran QRIS, serta panel administrasi terpadu.

## Kebutuhan Sistem

- PHP 8.3 ke atas (disarankan PHP 8.5)
- Composer
- Node.js & npm
- MySQL / MariaDB (port 3306)

## Cara Menjalankan Proyek

1. **Clone repository & masuk ke direktori proyek:**
   ```bash
   cd duren
   ```

2. **Impor Database:**
   - Buat database MySQL dengan nama `duren`.
   - Impor file `database.sql` ke dalam database `duren`.

3. **Salin berkas lingkungan:**
   ```bash
   cp .env.example .env
   ```
   Sesuaikan konfigurasi database serta kredensial akun admin di `.env`:
   ```env
   ADMIN_PHONE=62812xxxxxxxx
   ADMIN_PASSWORD=password_admin
   ```

4. **Instal dependensi PHP & JavaScript:**
   ```bash
   composer install
   npm install
   ```

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

6. **Seed Akun Admin:**
   ```bash
   php artisan db:seed
   ```

7. **Kompilasi aset antarmuka:**
   ```bash
   npm run build
   ```
   *(atau `npm run dev` untuk mode pengembangan)*

8. **Jalankan server aplikasi:**
   ```bash
   php artisan serve --port=8001
   ```
   Aplikasi dapat diakses melalui browser di `http://localhost:8001`.
