<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

try {
    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/html; charset=utf-8');
    echo "<div style='font-family:sans-serif;padding:30px;max-width:850px;margin:30px auto;background:#fff;border-left:6px solid #d93025;box-shadow:0 3px 15px rgba(0,0,0,0.1);border-radius:8px;'>";
    echo "<h2 style='color:#d93025;margin-top:0;'>⚠️ Fatal Error Terdeteksi di Laravel:</h2>";
    echo "<p style='font-size:16px;background:#fce8e6;padding:12px;border-radius:6px;color:#c5221f;'><strong>Pesan Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p style='color:#555;'><strong>File Sumber:</strong> <code>" . htmlspecialchars($e->getFile()) . "</code> (Baris " . $e->getLine() . ")</p>";
    echo "<h4 style='margin-bottom:8px;'>Stack Trace:</h4>";
    echo "<pre style='background:#202124;color:#f1f3f4;padding:15px;overflow:auto;font-size:12px;border-radius:6px;line-height:1.4;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    echo "</div>";
    exit(1);
}
