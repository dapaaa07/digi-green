<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

// 1. Auto-healing direktori storage & permissions (Mencegah "Please provide a valid cache path")
$requiredDirs = [
    __DIR__ . '/../storage/app/public',
    __DIR__ . '/../storage/framework/views',
    __DIR__ . '/../storage/framework/sessions',
    __DIR__ . '/../storage/framework/cache/data',
    __DIR__ . '/../storage/framework/cache/locks',
    __DIR__ . '/../storage/logs',
    __DIR__ . '/../bootstrap/cache',
];

$dirStatus = [];
foreach ($requiredDirs as $d) {
    $created = false;
    if (!is_dir($d)) {
        $created = @mkdir($d, 0775, true);
    }
    $dirStatus[$d] = [
        'exists' => is_dir($d),
        'writable' => is_writable($d),
        'auto_created' => $created,
    ];
}

// Quick zero-dependency diagnostic: buka https://cupunagara.my.id/?check=1
if (isset($_GET['check'])) {
    header('Content-Type: text/html; charset=utf-8');
    echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>Diagnostik Server Cupunagara</title>";
    echo "<style>body{font-family:system-ui,-apple-system,sans-serif;background:#f4f6f8;padding:25px;margin:0;color:#202124;} .card{max-width:800px;margin:20px auto;background:#fff;border-radius:12px;padding:30px;box-shadow:0 4px 20px rgba(0,0,0,0.08);} table{width:100%;border-collapse:collapse;margin:12px 0;font-size:13px;} th,td{padding:8px 12px;border:1px solid #e0e0e0;text-align:left;} th{background:#f8f9fa;} code{background:#f1f3f4;padding:2px 6px;border-radius:4px;font-family:monospace;font-size:12px;}</style>";
    echo "</head><body><div class='card'>";
    echo "<h2 style='color:#07370a;margin-top:0;'>Diagnostik Server Cupunagara</h2>";
    echo "<p>PHP Version: <strong>" . phpversion() . "</strong> | Document Root: <code>" . htmlspecialchars($_SERVER['DOCUMENT_ROOT'] ?? '') . "</code></p>";

    // Tampilkan Status Folder Storage & Cache
    echo "<h3 style='margin-top:20px;border-top:1px solid #eee;padding-top:15px;'>1. Status Direktori Storage & Cache:</h3>";
    echo "<table>";
    echo "<tr><th>Direktori</th><th>Keberadaan</th><th>Izin Tulis (Writable)</th></tr>";
    $basePath = realpath(__DIR__ . '/..') ?: dirname(__DIR__);
    foreach ($dirStatus as $path => $st) {
        $realP = realpath($path) ?: $path;
        $relPath = ltrim(str_replace([$basePath, realpath(__DIR__ . '/../..') ?: ''], '', $realP), '/\\');
        $existBadge = $st['exists'] 
            ? ($st['auto_created'] ? "<span style='color:#1a73e8;font-weight:bold;'>✅ Berhasil dibuat otomatis!</span>" : "<span style='color:#137333;font-weight:bold;'>✅ Ada</span>")
            : "<span style='color:#c5221f;font-weight:bold;'>❌ Tidak Ada!</span>";
        $writeBadge = $st['writable']
            ? "<span style='color:#137333;font-weight:bold;'>✅ Writable</span>"
            : "<span style='color:#c5221f;font-weight:bold;'>❌ Not Writable! (Jalankan chmod 775)</span>";
        echo "<tr><td><code>" . htmlspecialchars($relPath) . "</code></td><td>{$existBadge}</td><td>{$writeBadge}</td></tr>";
    }
    echo "</table>";

    // 2. Pemeriksaan File .env
    echo "<h3 style='margin-top:25px;border-top:1px solid #eee;padding-top:15px;'>2. Pemeriksaan File .env:</h3>";
    $envFile = __DIR__ . '/../.env';
    $dbHost = 'localhost';
    $dbPort = '3306';
    $dbName = '';
    $dbUser = '';
    $dbPass = '';

    if (file_exists($envFile)) {
        echo "<p style='color:#137333;font-weight:bold;'>✅ File .env DITEMUKAN</p>";
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        echo "<table>";
        echo "<tr><th>Parameter</th><th>Nilai Terbaca di Server</th></tr>";
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) continue;
            if (str_contains($line, '=')) {
                list($k, $v) = explode('=', $line, 2);
                $k = trim($k);
                $v = trim($v);
                $vClean = trim($v, '"\'');
                if ($k === 'DB_HOST') $dbHost = $vClean;
                if ($k === 'DB_PORT') $dbPort = $vClean;
                if ($k === 'DB_DATABASE') $dbName = $vClean;
                if ($k === 'DB_USERNAME') $dbUser = $vClean;
                if ($k === 'DB_PASSWORD') $dbPass = $vClean;

                if (in_array($k, ['APP_NAME', 'APP_ENV', 'APP_KEY', 'APP_DEBUG', 'APP_URL', 'DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'SESSION_DRIVER'])) {
                    if ($k === 'APP_KEY') {
                        $displayVal = empty($v) ? "<span style='color:red;font-weight:bold;'>❌ KOSONG!</span>" : "<span style='color:green;'>✅ Terisi (" . strlen($v) . " chars)</span>";
                    } else {
                        $displayVal = htmlspecialchars($v);
                    }
                    echo "<tr><td><code>{$k}</code></td><td>{$displayVal}</td></tr>";
                }
            }
        }
        echo "</table>";
    } else {
        echo "<p style='color:red;font-weight:bold;'>❌ File .env TIDAK DITEMUKAN di: " . htmlspecialchars($envFile) . "</p>";
    }

    $configCache = __DIR__ . '/../bootstrap/cache/config.php';
    if (file_exists($configCache)) {
        echo "<p style='color:red;font-weight:bold;'>⚠️ Ada file bootstrap/cache/config.php (HAPUS file ini di cPanel agar .env terbaca!)</p>";
    } else {
        echo "<p style='color:green;font-weight:bold;'>✅ Tidak ada file cache config (.env dibaca langsung)</p>";
    }

    // 3. Pengujian Langsung Koneksi Database MySQL
    echo "<h3 style='margin-top:25px;border-top:1px solid #eee;padding-top:15px;'>3. Pengujian Koneksi Database MySQL:</h3>";
    try {
        $dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";
        $pdo = new PDO($dsn, $dbUser, $dbPass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 4,
        ]);
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
        echo "<div style='background:#e6f4ea;color:#137333;padding:12px;border-radius:6px;font-weight:bold;'>";
        echo "✅ KONEKSI DATABASE BERHASIL!<br>";
        echo "<span style='font-weight:normal;font-size:13px;'>Ditemukan " . count($tables) . " tabel di database <code>" . htmlspecialchars($dbName) . "</code>.</span>";
        echo "</div>";
        if (count($tables) === 0) {
            echo "<p style='color:orange;font-size:13px;'>⚠️ Tabel masih kosong (0 tabel)! Silakan import file <code>database/cupunagara_backup.sql</code> di phpMyAdmin.</p>";
        }
    } catch (\Throwable $e) {
        echo "<div style='background:#fce8e6;color:#c5221f;padding:12px;border-radius:6px;'>";
        echo "<strong>❌ KONEKSI DATABASE GAGAL:</strong><br>";
        echo "<code>" . htmlspecialchars($e->getMessage()) . "</code>";
        echo "</div>";
    }

    // 4. Pengujian Eksekusi Laravel Kernel
    echo "<h3 style='margin-top:25px;border-top:1px solid #eee;padding-top:15px;'>4. Pengujian Respon Halaman Depan Laravel:</h3>";
    try {
        if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
            throw new \Exception("File vendor/autoload.php tidak ditemukan di: " . __DIR__ . '/../vendor/autoload.php');
        }
        require __DIR__.'/../vendor/autoload.php';

        if (!file_exists(__DIR__ . '/../bootstrap/app.php')) {
            throw new \Exception("File bootstrap/app.php tidak ditemukan di: " . __DIR__ . '/../bootstrap/app.php');
        }
        $app = require_once __DIR__.'/../bootstrap/app.php';

        $kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
        $req = \Illuminate\Http\Request::create('/');
        $resp = $kernel->handle($req);

        echo "<p>Status HTTP: <strong>" . $resp->getStatusCode() . "</strong></p>";
        if (isset($resp->exception)) {
            echo "<div style='background:#fce8e6;color:#c5221f;padding:15px;border-radius:6px;border-left:5px solid red;'>";
            echo "<h4 style='margin:0 0 8px 0;'>❌ Detail Exception yang Terjadi:</h4>";
            echo "<p style='font-size:15px;margin:0 0 8px 0;'><strong>" . htmlspecialchars($resp->exception->getMessage()) . "</strong></p>";
            echo "<p style='font-size:12px;color:#555;margin:0;'>File: <code>" . htmlspecialchars($resp->exception->getFile()) . "</code> (Baris " . $resp->exception->getLine() . ")</p>";
            echo "<p style='font-size:12px;color:#777;margin:4px 0 0 0;'>Tipe: <code>" . get_class($resp->exception) . "</code></p>";
            echo "</div>";
        } elseif ($resp->getStatusCode() === 200) {
            echo "<div style='background:#e6f4ea;color:#137333;padding:14px;border-radius:6px;font-weight:bold;font-size:15px;'>";
            echo "🎉 SUKSES! Halaman depan Laravel berhasil diproses dengan status 200 OK!";
            echo "</div>";
            echo "<p style='margin-top:15px;'><a href='/' style='background:#1a9120;color:white;padding:10px 20px;text-decoration:none;border-radius:6px;font-weight:bold;display:inline-block;'>Buka Website Cupunagara Sekarang &rarr;</a></p>";
        } else {
            echo "<div style='background:#fce8e6;color:#c5221f;padding:12px;border-radius:6px;'>";
            echo "Status HTTP Response: " . $resp->getStatusCode();
            echo "</div>";
        }
    } catch (\Throwable $e) {
        echo "<div style='background:#fce8e6;color:#c5221f;padding:15px;border-radius:6px;border-left:5px solid red;'>";
        echo "<strong>❌ Fatal Error saat Booting Laravel:</strong> " . htmlspecialchars($e->getMessage()) . "<br>";
        echo "<small>File: " . htmlspecialchars($e->getFile()) . " (" . $e->getLine() . ")</small><br>";
        echo "<pre style='font-size:11px;background:#202124;color:#f1f3f4;padding:10px;border-radius:4px;overflow:auto;margin-top:8px;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
        echo "</div>";
    }

    echo "</div></body></html>";
    exit;
}

use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// Tangkap request dan periksa jika terjadi error
$kernel = $app->make(HttpKernelContract::class);
$request = Request::capture();
$response = $kernel->handle($request);

if (isset($response->exception)) {
    http_response_code(500);
    header('Content-Type: text/html; charset=utf-8');
    echo "<div style='font-family:system-ui,-apple-system,sans-serif;padding:30px;max-width:850px;margin:40px auto;background:#fff;border-left:6px solid red;box-shadow:0 4px 20px rgba(0,0,0,0.1);border-radius:10px;'>";
    echo "<h2 style='color:red;margin-top:0;'>⚠️ Penyebab Pasti Error 500:</h2>";
    echo "<p style='font-size:16px;background:#fce8e6;padding:15px;border-radius:8px;color:#c00;line-height:1.5;'><strong>Pesan:</strong> " . htmlspecialchars($response->exception->getMessage()) . "</p>";
    echo "<p style='color:#555;'><strong>File:</strong> <code>" . htmlspecialchars($response->exception->getFile()) . "</code> (Baris " . $response->exception->getLine() . ")</p>";
    echo "<p style='color:#777;font-size:13px;'><strong>Tipe Exception:</strong> <code>" . get_class($response->exception) . "</code></p>";
    echo "<pre style='background:#202124;color:#f1f3f4;padding:15px;overflow:auto;font-size:11px;border-radius:6px;line-height:1.4;max-height:300px;'>" . htmlspecialchars($response->exception->getTraceAsString()) . "</pre>";
    echo "</div>";
    exit(0);
}

$response->send();
$kernel->terminate($request, $response);
