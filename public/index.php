<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

// Quick zero-dependency diagnostic: buka https://cupunagara.my.id/?check=1
if (isset($_GET['check'])) {
    header('Content-Type: text/html; charset=utf-8');
    echo "<div style='font-family:system-ui,-apple-system,sans-serif;padding:30px;max-width:750px;margin:30px auto;background:#fff;border-radius:10px;box-shadow:0 4px 20px rgba(0,0,0,0.1);'>";
    echo "<h2 style='color:#07370a;margin-top:0;'>Diagnostik Server Cupunagara</h2>";
    echo "<p>PHP Version: <strong>" . phpversion() . "</strong></p>";
    echo "<p>Document Root: <code>" . htmlspecialchars($_SERVER['DOCUMENT_ROOT'] ?? '') . "</code></p>";

    $envFile = __DIR__ . '/../.env';
    $dbHost = 'localhost';
    $dbPort = '3306';
    $dbName = '';
    $dbUser = '';
    $dbPass = '';

    if (file_exists($envFile)) {
        echo "<p style='color:#137333;font-weight:bold;'>✅ File .env DITEMUKAN</p>";
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        echo "<table border='1' cellpadding='6' style='border-collapse:collapse;width:100%;font-size:13px;margin:10px 0;'>";
        echo "<tr style='background:#f4f4f4;'><th>Parameter</th><th>Nilai Terbaca di Server</th></tr>";
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

    // 1. Pengujian Langsung Koneksi Database MySQL
    echo "<h3 style='margin-top:25px;border-top:1px solid #eee;padding-top:15px;'>1. Pengujian Koneksi Database MySQL:</h3>";
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

    // 2. Pengujian Eksekusi Laravel Kernel
    echo "<h3 style='margin-top:25px;border-top:1px solid #eee;padding-top:15px;'>2. Pengujian Respon Halaman Depan Laravel:</h3>";
    try {
        require __DIR__.'/../vendor/autoload.php';
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
        } else {
            echo "<div style='background:#e6f4ea;color:#137333;padding:12px;border-radius:6px;font-weight:bold;'>";
            echo "✅ Halaman depan Laravel berhasil diproses dengan status 200 OK!";
            echo "</div>";
        }
    } catch (\Throwable $e) {
        echo "<div style='background:#fce8e6;color:#c5221f;padding:15px;border-radius:6px;'>";
        echo "<strong>❌ Fatal Error saat Booting:</strong> " . htmlspecialchars($e->getMessage()) . "<br>";
        echo "<small>File: " . htmlspecialchars($e->getFile()) . " (" . $e->getLine() . ")</small>";
        echo "</div>";
    }

    echo "</div>";
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
    echo "<h2 style='color:#d93025;margin-top:0;'>⚠️ Detail Error 500 Terdeteksi:</h2>";
    echo "<p style='font-size:16px;background:#fce8e6;padding:15px;border-radius:8px;color:#c00;line-height:1.5;'><strong>Pesan:</strong> " . htmlspecialchars($response->exception->getMessage()) . "</p>";
    echo "<p style='color:#555;'><strong>File:</strong> <code>" . htmlspecialchars($response->exception->getFile()) . "</code> (Baris " . $response->exception->getLine() . ")</p>";
    echo "<p style='color:#777;font-size:13px;'><strong>Tipe Exception:</strong> <code>" . get_class($response->exception) . "</code></p>";
    echo "</div>";
    exit(0);
}

$response->send();
$kernel->terminate($request, $response);
