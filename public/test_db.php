<?php
/**
 * Digi-Green Cupunagara - Quick Database & Environment Tester
 * Buka URL ini di browser untuk mengetahui penyebab error database secara instan.
 * Hapus file ini jika website sudah berjalan normal.
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: text/html; charset=utf-8');

$envPath = __DIR__ . '/../.env';
if (!file_exists($envPath)) {
    die('<div style="font-family:sans-serif;padding:20px;color:red;background:#ffe6e6;border:1px solid red;border-radius:8px;">
        <h3>❌ File .env Tidak Ditemukan!</h3>
        <p>Pastikan Anda sudah menyalin <code>.env.example</code> menjadi <code>.env</code> di folder utama website Anda.</p>
    </div>');
}

$envContent = file_get_contents($envPath);
$env = [];
foreach (explode("\n", $envContent) as $line) {
    $line = trim($line);
    if ($line === '' || str_starts_with($line, '#')) continue;
    if (strpos($line, '=') !== false) {
        list($key, $val) = explode('=', $line, 2);
        $key = trim($key);
        $val = trim($val);
        $val = trim($val, '"\'');
        $env[$key] = $val;
    }
}

$dbHost = $env['DB_HOST'] ?? '127.0.0.1';
$dbPort = $env['DB_PORT'] ?? '3306';
$dbName = $env['DB_DATABASE'] ?? '';
$dbUser = $env['DB_USERNAME'] ?? '';
$dbPass = $env['DB_PASSWORD'] ?? '';

echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Diagnostik Database Cupunagara</title>
<style>
body { font-family: system-ui, sans-serif; background: #f4f6f8; padding: 30px; color: #333; }
.card { background: white; max-width: 650px; margin: 0 auto; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
h2 { margin-top: 0; color: #07370a; }
.badge-ok { background: #e6f4ea; color: #137333; padding: 8px 14px; border-radius: 6px; font-weight: bold; display: inline-block; }
.badge-err { background: #fce8e6; color: #c5221f; padding: 8px 14px; border-radius: 6px; font-weight: bold; display: inline-block; }
pre { background: #272822; color: #f8f8f2; padding: 12px; border-radius: 6px; overflow-x: auto; font-size: 13px; }
table { width: 100%; border-collapse: collapse; margin-top: 15px; }
td, th { padding: 8px 12px; border: 1px solid #e0e0e0; text-align: left; font-size: 13px; }
th { background: #f8f9fa; }
</style>
</head><body><div class="card">';

echo '<h2>Diagnostik Database & Server (.env)</h2>';

echo '<table>';
echo '<tr><th>Parameter</th><th>Nilai di .env</th></tr>';
echo '<tr><td>DB_HOST</td><td><code>' . htmlspecialchars($dbHost) . '</code></td></tr>';
echo '<tr><td>DB_PORT</td><td><code>' . htmlspecialchars($dbPort) . '</code></td></tr>';
echo '<tr><td>DB_DATABASE</td><td><code>' . htmlspecialchars($dbName) . '</code></td></tr>';
echo '<tr><td>DB_USERNAME</td><td><code>' . htmlspecialchars($dbUser) . '</code></td></tr>';
echo '<tr><td>DB_PASSWORD</td><td><code>' . (empty($dbPass) ? '<em>(Kosong)</em>' : '******** (' . strlen($dbPass) . ' karakter)') . '</code></td></tr>';
echo '</table>';

echo '<h3 style="margin-top:20px;">Hasil Pengujian Koneksi:</h3>';

try {
    $dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 3,
    ]);
    
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo '<div class="badge-ok">✅ KONEKSI DATABASE BERHASIL!</div>';
    echo '<p style="margin-top:10px;">Ditemukan <strong>' . count($tables) . '</strong> tabel di database <code>' . htmlspecialchars($dbName) . '</code>:</p>';
    if (count($tables) > 0) {
        echo '<ul>';
        foreach ($tables as $t) {
            echo '<li><code>' . htmlspecialchars($t) . '</code></li>';
        }
        echo '</ul>';
    } else {
        echo '<p style="color:#e37400;">⚠️ <strong>Peringatan:</strong> Database masih kosong (0 tabel)! Silakan import file <code>database/cupunagara_backup.sql</code> melalui phpMyAdmin.</p>';
    }

} catch (PDOException $e) {
    echo '<div class="badge-err">❌ KONEKSI DATABASE GAGAL!</div>';
    echo '<pre>' . htmlspecialchars($e->getMessage()) . '</pre>';
    
    echo '<h4 style="margin-top:15px;color:#c5221f;">Analisa & Solusi:</h4>';
    $msg = $e->getMessage();
    if (strpos($msg, 'Access denied') !== false) {
        echo '<p>👉 <strong>User atau Password salah, atau User belum di-assign ke Database.</strong><br>
        1. Buka cPanel &rarr; <strong>MySQL Databases</strong>.<br>
        2. Di bagian <strong>Add User To Database</strong>, pilih user dan database Anda &rarr; klik <strong>Add</strong> &rarr; centang <strong>ALL PRIVILEGES</strong> &rarr; Make Changes.<br>
        3. Pastikan password di <code>.env</code> sama persis dengan yang Anda buat.</p>';
    } elseif (strpos($msg, 'Unknown database') !== false) {
        echo '<p>👉 <strong>Database "' . htmlspecialchars($dbName) . '" tidak ditemukan.</strong><br>
        Di cPanel shared hosting, nama database harus menyertakan prefix username cPanel (contoh: <code>username_cupunagara</code>, bukan cuma <code>cupunagara</code>).</p>';
    } elseif (strpos($msg, 'Connection refused') !== false || strpos($msg, 'No such file') !== false) {
        echo '<p>👉 <strong>Host MySQL tidak dapat dihubungi.</strong><br>
        Coba ganti <code>DB_HOST=127.0.0.1</code> menjadi <code>DB_HOST=localhost</code> (atau sebaliknya) di file <code>.env</code>.</p>';
    } else {
        echo '<p>Periksa kembali konfigurasi database di cPanel dan file <code>.env</code>.</p>';
    }
}

echo '<hr style="margin-top:25px;border:0;border-top:1px solid #eee;">';
echo '<p style="font-size:12px;color:#666;">💡 Catatan: Jika website sudah berhasil dibuka normal, silakan hapus file <code>public/test_db.php</code> ini.</p>';
echo '</div></body></html>';
