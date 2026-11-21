<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

// Quick zero-dependency diagnostic: buka https://cupunagara.my.id/?check=1
if (isset($_GET['check'])) {
    header('Content-Type: text/html; charset=utf-8');
    echo "<div style='font-family:system-ui,-apple-system,sans-serif;padding:30px;max-width:700px;margin:30px auto;background:#fff;border-radius:10px;box-shadow:0 4px 20px rgba(0,0,0,0.1);'>";
    echo "<h2 style='color:#07370a;margin-top:0;'>Diagnostik Server Cupunagara</h2>";
    echo "<p>PHP Version: <strong>" . phpversion() . "</strong></p>";
    echo "<p>Document Root: <code>" . htmlspecialchars($_SERVER['DOCUMENT_ROOT'] ?? '') . "</code></p>";
    echo "<p>Index File: <code>" . htmlspecialchars(__FILE__) . "</code></p>";

    $envFile = __DIR__ . '/../.env';
    if (file_exists($envFile)) {
        echo "<p style='color:#137333;font-weight:bold;'>✅ File .env DITEMUKAN</p>";
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        echo "<table border='1' cellpadding='6' style='border-collapse:collapse;width:100%;font-size:13px;margin:10px 0;'>";
        echo "<tr style='background:#f4f4f4;'><th>Key</th><th>Value Terbaca</th></tr>";
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) continue;
            if (str_contains($line, '=')) {
                list($k, $v) = explode('=', $line, 2);
                $k = trim($k);
                $v = trim($v);
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

    $storage = __DIR__ . '/../storage';
    echo "<p>Storage Writable: " . (is_writable($storage) ? "<span style='color:green;font-weight:bold;'>✅ YES</span>" : "<span style='color:red;font-weight:bold;'>❌ NO</span>") . "</p>";

    $configCache = __DIR__ . '/../bootstrap/cache/config.php';
    if (file_exists($configCache)) {
        echo "<p style='color:red;font-weight:bold;'>⚠️ Ada file bootstrap/cache/config.php (HAPUS file ini di cPanel agar .env terbaca!)</p>";
    } else {
        echo "<p style='color:green;font-weight:bold;'>✅ Tidak ada file cache config (.env dibaca langsung)</p>";
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
