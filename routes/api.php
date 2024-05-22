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
use App\Http\Controllers\PemesananController;

// uji coba
Route::get('/p', function() { 
    dd('test');
});

Route::post('/register', [AkunController::class, 'register']);
Route::post('/login1', [AkunController::class, 'loginweb']);
Route::post('/login2', [AkunController::class, 'loginmobile']);
// Route::post('/logout', [AkunController::class, 'logout']);
Route::post('/dt', [PemesananController::class, 'create']);


Route::get('/bs', [BaseController::class, 'index']);
Route::get('/uk', [UkuranController::class, 'index']);
Route::get('/ds', [DesainController::class, 'index']);
Route::get('/kue', [KueController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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


