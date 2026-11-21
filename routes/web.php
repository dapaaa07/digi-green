<?php

use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDestinationController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', HomeController::class)->name('home');
Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');

Route::prefix('wisata')->name('destinations.')->group(function () {
    Route::get('/', [DestinationController::class, 'index'])->name('index');
    Route::get('/{slug}', [DestinationController::class, 'show'])->name('show');
});

Route::get('/kopi', [CoffeeController::class, 'index'])->name('coffee.index');

Route::prefix('lapor')->name('reports.')->group(function () {
    Route::get('/', [ReportController::class, 'create'])->name('create');
    Route::post('/kirim', [ReportController::class, 'store'])->name('store');
});
Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');

Route::get('/qr/{code?}', [QrController::class, 'show'])->name('qr.show');

Route::prefix('kabar')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{slug}', [ArticleController::class, 'show'])->name('show');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [AdminReportController::class, 'index'])->name('index');
            Route::get('/{report}', [AdminReportController::class, 'show'])->name('show');
            Route::put('/{report}', [AdminReportController::class, 'update'])->name('update');
            Route::delete('/{report}', [AdminReportController::class, 'destroy'])->name('destroy');
        });

        Route::get('/qr-print', [AdminDashboardController::class, 'printQr'])->name('qr.print');
        Route::resource('destinations', AdminDestinationController::class);
        Route::resource('products', AdminProductController::class);
        Route::resource('articles', AdminArticleController::class);
    });
});
