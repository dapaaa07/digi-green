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

// Handle incoming request with transparent exception inspection
$kernel = $app->make(HttpKernelContract::class);
$request = Request::capture();
$response = $kernel->handle($request);

if (isset($response->exception)) {
    http_response_code(500);
    header('Content-Type: text/html; charset=utf-8');
    echo "<div style='font-family:system-ui,-apple-system,sans-serif;padding:30px;max-width:850px;margin:40px auto;background:#fff;border-left:6px solid #d93025;box-shadow:0 4px 20px rgba(0,0,0,0.1);border-radius:10px;'>";
    echo "<h2 style='color:#d93025;margin-top:0;'>⚠️ Detail Error 500 Terdeteksi:</h2>";
    echo "<p style='font-size:16px;background:#fce8e6;padding:15px;border-radius:8px;color:#c5221f;line-height:1.5;'><strong>Pesan:</strong> " . htmlspecialchars($response->exception->getMessage()) . "</p>";
    echo "<p style='color:#555;'><strong>File:</strong> <code>" . htmlspecialchars($response->exception->getFile()) . "</code> (Baris " . $response->exception->getLine() . ")</p>";
    echo "<p style='color:#777;font-size:13px;'><strong>Tipe:</strong> <code>" . get_class($response->exception) . "</code></p>";
    echo "<h4 style='margin-bottom:6px;color:#333;'>Trace:</h4>";
    echo "<pre style='background:#202124;color:#f1f3f4;padding:15px;overflow:auto;font-size:11px;border-radius:6px;line-height:1.4;max-height:300px;'>" . htmlspecialchars($response->exception->getTraceAsString()) . "</pre>";
    echo "</div>";
    exit(0);
}

$response->send();
$kernel->terminate($request, $response);
