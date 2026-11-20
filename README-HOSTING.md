# Panduan Hosting Digi-Green Cupunagara di Subdomain (`stagging.dafung.web.id`)

Panduan lengkap untuk mempublikasikan website **Digi-Green Desa Wisata Cupunagara** ke subdomain `https://stagging.dafung.web.id` pada hosting **cPanel (LiteSpeed / Apache) + Cloudflare**.

---

## 📌 Ringkasan Parameter Staging

| Parameter | Nilai Rekomendasi |
| :--- | :--- |
| **Domain / Subdomain** | `stagging.dafung.web.id` |
| **Document Root** | `stagging.dafung.web.id/public` (atau `public_html/stagging/public`) |
| **PHP Version** | **PHP 8.3** atau **PHP 8.4** |
| **Database** | MySQL / MariaDB (Import dari `database/cupunagara_backup.sql`) |
| **Repository GitHub** | `https://github.com/dapaaa07/digi-green.git` |
| **File ZIP Siap Upload** | `/opt/lampp/htdocs/digi-green-deploy.zip` (20 MB, sudah include vendor & build Vite) |

---

## 🌐 Langkah 1: Pengaturan DNS di Cloudflare

Karena domain `dafung.web.id` terhubung ke **Cloudflare**, Anda wajib menambahkan DNS record untuk subdomain `stagging` agar dapat diakses:

1. Buka [Cloudflare Dashboard](https://dash.cloudflare.com/) $\rightarrow$ Pilih domain **dafung.web.id** $\rightarrow$ Masuk ke menu **DNS** $\rightarrow$ **Records**.
2. Klik **Add record**:
   - **Type**: `CNAME`
   - **Name**: `stagging`
   - **Target**: `dafung.web.id`
   - **Proxy status**: **Proxied** (awan oranye aktif untuk SSL gratis & proteksi Cloudflare).
   *(Atau pilih Type `A`, Name `stagging`, IPv4 address isi dengan IP server hosting cPanel Anda).*
3. Klik **Save**. Tunggu 1–2 menit hingga DNS tersinkronisasi.

---

## ⚙️ Langkah 2: Buat Subdomain di cPanel

1. Login ke **cPanel** akun hosting Anda.
2. Cari menu **Domains** (atau **Subdomains**).
3. Klik **Create A New Domain**:
   - **Domain**: `stagging.dafung.web.id`
   - **Pastikan UNCHECK** opsi *"Share document root (/home/username/public_html) with 'dafung.web.id'"*.
   - **Document Root**: Isi dengan path yang mengarah ke folder **`/public`**, contoh:
     `stagging.dafung.web.id/public` atau `public_html/stagging/public`.
     > ⚠️ **SANGAT PENTING**: Laravel mewajibkan web server mengarah ke folder `/public` demi keamanan file sistem dan agar route Laravel berfungsi normal.
4. Klik **Submit**.

---

## 🐘 Langkah 3: Pastikan Versi PHP 8.3 / 8.4

1. Di cPanel, cari menu **MultiPHP Manager** atau **Select PHP Version**.
2. Pilih domain/subdomain `stagging.dafung.web.id`.
3. Set versi ke **PHP 8.3** atau **PHP 8.4** lalu klik **Apply**.
4. Pastikan ekstensi berikut aktif: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `curl`, `fileinfo`.

---

## 🗄️ Langkah 4: Buat Database MySQL & Import Data

1. Di cPanel, buka menu **MySQL Databases**:
   - Buat database baru, contoh: `username_cupunagara`.
   - Buat user database baru, contoh: `username_cupuuser`, dan tentukan password yang kuat.
   - Di bagian **Add User To Database**, hubungkan user tadi ke database dengan mencentang **ALL PRIVILEGES**.
2. Masuk ke **phpMyAdmin** dari cPanel:
   - Pilih database `username_cupunagara` yang baru dibuat.
   - Klik tab **Import**.
   - Pilih file `cupunagara_backup.sql` (tersedia di folder `database/cupunagara_backup.sql` dalam project ini).
   - Klik tombol **Import / Go**. Seluruh tabel destinasi, produk kopi, artikel, plang QR, dan akun admin akan langsung terisi lengkap!

---

## 🚀 Langkah 5: Pilihan Deploy File ke Server

Pilih salah satu metode yang paling nyaman bagi Anda:

### METODE A: Upload File ZIP Siap Pakai (Paling Cepat & Tanpa Terminal)

File ZIP siap deploy sudah dibuatkan di:
`/opt/lampp/htdocs/digi-green-deploy.zip` (Ukuran ~20 MB).

1. Buka **File Manager** di cPanel.
2. Buka folder root subdomain Anda (misalnya `/home/username/stagging.dafung.web.id`).
3. Upload file `digi-green-deploy.zip`.
4. Klik kanan file ZIP $\rightarrow$ pilih **Extract**.
5. Salin file `.env.example` menjadi `.env`, lalu edit isinya:
   ```env
   APP_NAME="Desa Wisata Cupunagara"
   APP_ENV=production
   APP_KEY=base64:KgzgIkI0kc3H7IutNbUQV5LBg8qC5HOZwAB0ePs0l9w=
   APP_DEBUG=false
   APP_URL=https://stagging.dafung.web.id

   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=username_cupunagara
   DB_USERNAME=username_cupuuser
   DB_PASSWORD=PasswordDatabaseAnda
   ```
6. Selesai! Buka `https://stagging.dafung.web.id` di browser.

---

### METODE B: Menggunakan Git Version Control cPanel & Terminal

1. Buka menu **Git™ Version Control** di cPanel $\rightarrow$ Klik **Create**.
2. Masukkan URL: `https://github.com/dapaaa07/digi-green.git`.
3. Tentukan repository path ke folder subdomain Anda.
4. Klik **Create**.
5. Buka **Terminal** di cPanel, masuk ke folder project:
   ```bash
   cd ~/stagging.dafung.web.id
   cp .env.example .env
   ```
6. Sesuaikan konfigurasi `.env` (Database & APP_URL).
7. Jalankan perintah optimasi Laravel:
   ```bash
   php artisan key:generate
   php artisan storage:link
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

## 🔒 Langkah 6: Verifikasi & Login Admin

1. Buka browser: `https://stagging.dafung.web.id`
   - Pastikan halaman beranda bertema **Jadesta Kemenpar** muncul dengan logo Digi-Green, peta sebaran, wisata, produk kopi, dan tombol lapor kebersihan.
2. Login Admin Karang Taruna:
   - URL: `https://stagging.dafung.web.id/admin/login`
   - Email: `admin@cupunagara.desa.id`
   - Password: `password123`
3. Cek halaman cetak QR plang bambu:
   - URL: `https://stagging.dafung.web.id/admin/qr/print`
   - Anda dapat langsung mencetak stiker QR code untuk ditempel di plang bambu lokasi wisata.
