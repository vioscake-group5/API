<?php

use App\Http\Controllers\AuthController as ControllersAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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