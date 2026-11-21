# Panduan Hosting & Migrasi Digi-Green Cupunagara (`cupunagara.my.id`)

Panduan lengkap untuk mempublikasikan website **Digi-Green Desa Wisata Cupunagara** ke domain utama `https://cupunagara.my.id` pada hosting **cPanel (LiteSpeed / Apache) + Cloudflare**.

---

## 📌 Ringkasan Parameter Hosting

| Parameter | Nilai Rekomendasi |
| :--- | :--- |
| **Domain Utama** | `cupunagara.my.id` (dan `www.cupunagara.my.id`) |
| **Document Root** | `cupunagara.my.id/public` (atau `public_html/public`) |
| **PHP Version** | **PHP 8.3** atau **PHP 8.4** |
| **Database** | MySQL / MariaDB (Import dari `database/cupunagara_backup.sql`) |
| **Repository GitHub** | `https://github.com/dapaaa07/digi-green.git` |
| **File ZIP Siap Upload** | `/opt/lampp/htdocs/digi-green-deploy.zip` (20 MB, sudah include vendor & build Vite) |

---

## 🌐 Langkah 1: Pengaturan DNS & SSL di Cloudflare

Untuk menghubungkan domain `cupunagara.my.id` ke hosting cPanel melalui Cloudflare:

### 1.1. Daftarkan Domain & Ganti Nameserver
1. Buka [Cloudflare Dashboard](https://dash.cloudflare.com/) $\rightarrow$ Klik **Add a site** $\rightarrow$ Masukkan `cupunagara.my.id`.
2. Pilih paket **Free** $\rightarrow$ Catat **2 Nameserver Cloudflare** yang diberikan (contoh: `xxx.ns.cloudflare.com` & `yyy.ns.cloudflare.com`).
3. Buka dashboard tempat Anda membeli domain `cupunagara.my.id` (Niagahoster, DomaiNesia, IDCloudHost, Rumahweb, dll.) $\rightarrow$ Ubah Nameserver domain menjadi 2 Nameserver Cloudflare tersebut.

### 1.2. Tambahkan DNS Records
Masuk ke menu **DNS** $\rightarrow$ **Records** pada domain `cupunagara.my.id`:

| Type | Name | IPv4 address / Target | Proxy Status | TTL | Keterangan |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **A** | `@` | `<IP_SERVER_CPANEL>` | **Proxied** (Awan Oranye) | Auto | Domain utama |
| **CNAME** | `www` | `cupunagara.my.id` | **Proxied** (Awan Oranye) | Auto | Subdomain www |
| **A** *(opsional)* | `mail` | `<IP_SERVER_CPANEL>` | **DNS Only** (Awan Abu-abu) | Auto | Khusus webmail |

*(Catatan: `<IP_SERVER_CPANEL>` dapat dilihat di cPanel sebelah kanan pada kolom **Shared IP Address**).*

### 1.3. Konfigurasi SSL/TLS (Pencegahan ERR_TOO_MANY_REDIRECTS)
1. Buka menu **SSL/TLS** $\rightarrow$ **Overview**:
   - Pilih mode: **Full** (atau **Full (strict)** jika AutoSSL di cPanel sudah terbit).
   - ⚠️ *PENTING: Jangan gunakan mode Flexible karena akan menimbulkan redirect loop pada Laravel.*
2. Buka menu **SSL/TLS** $\rightarrow$ **Edge Certificates**:
   - **Always Use HTTPS**: **ON**
   - **Automatic HTTPS Rewrites**: **ON**
   - **Minimum TLS Version**: **TLS 1.2**

---

## ⚙️ Langkah 2: Tambahkan Domain di cPanel

1. Login ke **cPanel** akun hosting Anda.
2. Cari menu **Domains**.
3. Klik **Create A New Domain**:
   - **Domain**: `cupunagara.my.id`
   - **Pastikan UNCHECK** opsi *"Share document root"*.
   - **Document Root**: Isi dengan path yang mengarah ke folder **`/public`**, contoh:
     `cupunagara.my.id/public` (atau `public_html/public` jika sebagai domain utama cPanel).
     > ⚠️ **SANGAT PENTING**: Laravel mewajibkan web server mengarah ke folder `/public` demi keamanan file sistem dan agar route Laravel berfungsi normal.
4. Klik **Submit**.

---

## 🐘 Langkah 3: Pastikan Versi PHP 8.3 / 8.4

1. Di cPanel, cari menu **MultiPHP Manager** atau **Select PHP Version**.
2. Pilih domain `cupunagara.my.id`.
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
2. Buka folder root domain Anda (misalnya `/home/username/cupunagara.my.id` atau `public_html`).
3. Upload file `digi-green-deploy.zip`.
4. Klik kanan file ZIP $\rightarrow$ pilih **Extract**.
5. Salin file `.env.example` menjadi `.env`, lalu edit isinya:
   ```env
   APP_NAME="Desa Wisata Cupunagara"
   APP_ENV=production
   APP_KEY=base64:KgzgIkI0kc3H7IutNbUQV5LBg8qC5HOZwAB0ePs0l9w=
   APP_DEBUG=false
   APP_URL=https://cupunagara.my.id

   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=username_cupunagara
   DB_USERNAME=username_cupuuser
   DB_PASSWORD=PasswordDatabaseAnda
   ```
6. Selesai! Buka `https://cupunagara.my.id` di browser.

---

### METODE B: Menggunakan Git Version Control cPanel & Terminal

1. Buka menu **Git™ Version Control** di cPanel $\rightarrow$ Klik **Create**.
2. Masukkan URL: `https://github.com/dapaaa07/digi-green.git`.
3. Tentukan repository path ke folder domain Anda.
4. Klik **Create**.
5. Buka **Terminal** di cPanel, masuk ke folder project:
   ```bash
   cd ~/cupunagara.my.id
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

1. Buka browser: `https://cupunagara.my.id`
   - Pastikan halaman beranda bertema **Jadesta Kemenpar** muncul dengan logo Digi-Green, peta sebaran, wisata, produk kopi, dan tombol lapor kebersihan.
2. Login Admin Karang Taruna:
   - URL: `https://cupunagara.my.id/admin/login`
   - Email: `admin@cupunagara.desa.id`
   - Password: `password123`
3. Cek halaman cetak QR plang bambu:
   - URL: `https://cupunagara.my.id/admin/qr/print`
   - Anda dapat langsung mencetak stiker QR code untuk ditempel di plang bambu lokasi wisata.

