<?php

use App\Http\Controllers\AuthController as ControllersAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
    return view('welcome');
});


Route::get('/check-db-connection', function () {
    try {
        DB::connection()->getPdo();
        return "Connected to the database.";
    } catch (\Exception $e) {
        return "Unable to connect to the database. Error: " . $e->getMessage();
    }
});

use App\Http\Controllers\AkunController;

Route::post('/login', [AkunController::class, 'login']);