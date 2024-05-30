<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CakeController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\DetailController;
use App\Http\Controllers\Api\OrderController;

use App\Http\Controllers\AkunController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\UkuranController;
use App\Http\Controllers\DesainController;
use App\Http\Controllers\KueController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PesananController;

/*
    how to run in handphone

    hanya test API
    - by testing (download app nya di playstore, cari API Tester)
    - cmd -> ipconfig -> copy IPv4
    - jalankan laravel di terminal dengan : php artisan serve --host your-ip --port 8000
    - sisanya sama kayak ngetest di postman

    test di flutter
    - pendeknya -> liat pull request yang aku taruh di flutter_mobile
    - panjangnya -> aku lupa 
*/

// uji coba
Route::get('/p', function() { 
    dd('test');
});
// registrasi
Route::post('/register', [AkunController::class, 'register']);
// login web
Route::post('/login1', [AkunController::class, 'loginweb']);
// login mobile
Route::post('/login2', [AkunController::class, 'loginmobile']);
// Route::post('/logout', [AkunController::class, 'logout']);
// buat pesanan
Route::post('/dt', [PemesananController::class, 'create']);

// data base
Route::get('/bs', [BaseController::class, 'index']);
// data ukuran
Route::get('/uk', [UkuranController::class, 'index']);
// data desain utama
Route::get('/ds', [DesainController::class, 'index']);
// data kue (rencana dak aku pake, langsung disatuin ke pemesanan)
Route::get('/kue', [KueController::class, 'index']);
// data pemesanan
Route::get('/pm', [PemesananController::class, 'index']);
// data pesanan all + pesanan one by id
Route::get('/ps1', [PesananController::class, 'index']);
Route::get('/ps0/{id}', [PesananController::class, 'show']);

// chat
Route::get('/messageData', [MessageController::class, 'index']);
Route::post('/send', [MessageController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

// Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');
Route::get('google/login/url', '\App\Http\Controllers\api\GoogleController@getAuthUrl');
Route::post('google/auth/login', '\App\Http\Controllers\api\GoogleController@postLogin');

// Route::middleware('auth:api')->group(function () {
//     Route::get('/cakes', [CakeController::class, 'index']);
//     Route::post('/cakes', [CakeController::class, 'store']);
//     Route::get('/cakes/{id}', [CakeController::class, 'show']);
//     Route::post('/cakes/{id}', [CakeController::class, 'update']);
//     Route::delete('/cakes/{id}', [CakeController::class, 'destroy']);
//     Route::post('/images', [ImageController::class, 'store']);
//     Route::post('/detail', [DetailController::class, 'store']);
//     Route::post('/set-location', [DetailController::class, 'setLocation']);
//     Route::get('/get-location', [DetailController::class, 'getLocation']);
//     Route::post('/order', [OrderController::class, 'store']);
//     Route::get('/history-order', [OrderController::class, 'historyOrder']);
// }); 


