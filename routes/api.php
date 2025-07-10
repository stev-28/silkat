<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryProxyController;
use App\Http\Controllers\SopController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route untuk mengambil data galeri dari website eksternal melalui proxy
// Ini akan menjadi: GET /api/galeri-eksternal
Route::get('/galeri-eksternal', [GalleryProxyController::class, 'fetchExternalGallery']);

// Jika Anda memiliki rute API lain yang valid, tambahkan di bawah ini.
// Contoh:
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// routes/api.php
Route::get('/sop', [SopController::class, 'index']);
Route::get('/galeri-tes', function() {
    return ['ok' => true];
});
Route::get('/berita-dlhp', [\App\Http\Controllers\BeritaProxyController::class, 'fetchBerita']);
Route::get('/berita-content', [\App\Http\Controllers\BeritaContentController::class, 'getContent']);