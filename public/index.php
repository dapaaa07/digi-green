<?php

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
    echo "<p style='font-size:18px;background:#fee;padding:15px;border-radius:8px;color:#c00;line-height:1.5;'><strong>Pesan:</strong> " . htmlspecialchars($response->exception->getMessage()) . "</p>";
    echo "<p style='color:#555;'><strong>File:</strong> <code>" . htmlspecialchars($response->exception->getFile()) . "</code> (Baris " . $response->exception->getLine() . ")</p>";
    echo "<p style='color:#777;font-size:13px;'><strong>Tipe Exception:</strong> <code>" . get_class($response->exception) . "</code></p>";
    echo "</div>";
    exit(0);
}

$response->send();
$kernel->terminate($request, $response);
