<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CakeController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\DetailController;
use App\Http\Controllers\Api\OrderController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * route "/register"
 * @method "POST"
 */
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

/**
 * route "/login"
 * @method "POST"
 */
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

/**
 * route "/user"
 * @method "GET"
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * route "/logout"
 * @method "POST"
 */
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');
Route::get('google/login/url', '\App\Http\Controllers\api\GoogleController@getAuthUrl');
Route::post('google/auth/login', '\App\Http\Controllers\api\GoogleController@postLogin');

Route::middleware('auth:api')->group(function () {
    Route::get('/cakes', [CakeController::class, 'index']);
    Route::post('/cakes', [CakeController::class, 'store']);
    Route::get('/cakes/{id}', [CakeController::class, 'show']);
    Route::post('/cakes/{id}', [CakeController::class, 'update']);
    Route::delete('/cakes/{id}', [CakeController::class, 'destroy']);
    Route::post('/images', [ImageController::class, 'store']);
    Route::post('/detail', [DetailController::class, 'store']);
    Route::post('/set-location', [DetailController::class, 'setLocation']);
    Route::get('/get-location', [DetailController::class, 'getLocation']);
    Route::post('/order', [OrderController::class, 'store']);
    Route::get('/history-order', [OrderController::class, 'historyOrder']);
});