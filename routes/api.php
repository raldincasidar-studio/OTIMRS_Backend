<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TouristController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/register_tourist', [TouristController::class, 'add']);


// Add a route middleware that checks the request header contains a token
Route::middleware(['check_admin_auth'])->group(function() {
    // Route::get('/piste', [UserController::class, 'login']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/tourists', [TouristController::class, 'get']);
    Route::get('/tourists/{id}', [TouristController::class, 'person']);
    
});