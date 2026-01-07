<?php

use App\Http\Controllers\App\DashboardController;
use App\Http\Controllers\App\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\Auth\LoginController;

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:customer'])->prefix('app')->name('app.')->group(function () {

    // 1. Dashboard Utama (Bisa diakses Brand & Customer)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Project Management
    Route::controller(ProjectController::class)->prefix('projects')->name('projects.')->group(function () {

        // Bisa diakses semua role yang login (Brand & Customer)
        Route::get('/', 'index')->name('index');
        Route::get('/{project}', 'show')->name('show');

        // KHUSUS CUSTOMER: Menggunakan middleware role Spatie
        Route::middleware(['role:customer'])->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
        });

        // KHUSUS BRAND atau CASE TERTENTU (Opsional)
        Route::patch('/{project}/status', 'updateStatus')->name('update-status');
    });

    // 3. Wallet & Transactions
    Route::get('/wallet', function () {
        return view('app.wallet.index');
    })->name('wallet');

    // 4. Profile Settings
    Route::get('/profile', function () {
        return view('app.profile.settings');
    })->name('profile');
});

Route::view('/brand', 'brand');
