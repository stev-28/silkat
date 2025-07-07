<?php

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

// Route untuk halaman utama aplikasi SILKAT
// Ini akan memuat tampilan 'welcome.blade.php'
Route::get('/', function () {
    return view('welcome');
});

// Pastikan tidak ada rute lain di sini yang merujuk ke '/galeri' atau '/api/galeri-eksternal'.