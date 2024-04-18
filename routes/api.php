<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TouristController;
use App\Http\Controllers\TouristAttractionController;
use App\Http\Controllers\ActivityController;

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
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/activities/get', [ActivityController::class, 'get']);
Route::get('/tourist-attractions/getAttraction', [TouristAttractionController::class, 'getAttraction']);
Route::get('/tourist-attractions/getAcommodation', [TouristAttractionController::class, 'getAcommodation']);


// Add a route middleware that checks the request header contains a token
Route::middleware(['check_admin_auth'])->group(function() {
    // Route::get('/piste', [UserController::class, 'login']);
    Route::get('/tourists', [TouristController::class, 'get']);
    Route::get('/tourists/{id}', [TouristController::class, 'person']);
    Route::post('/tourist-attractions/add', [TouristAttractionController::class, 'add']);
    Route::get('/tourist-attractions/get', [TouristAttractionController::class, 'get']);
    Route::post('/tourist-attractions/update/{id}', [TouristAttractionController::class, 'update']);
    Route::delete('/tourist-attractions/delete/{id}', [TouristAttractionController::class, 'delete']);

    
    Route::get('/activities/{id}', [ActivityController::class, 'getOne']);
    Route::post('/activities/add', [ActivityController::class, 'add']);
    Route::post('/activities/edit/{id}', [ActivityController::class, 'edit']);
    Route::delete('/activities/delete/{id}', [ActivityController::class, 'delete']);
    
    Route::get('/arrivals', [TouristController::class, 'getArrivals']);
    
    
    
    Route::get('/admins', [UserController::class, 'get']);
    Route::post('/admins', [UserController::class, 'register']);
    Route::get('/admins/{id}', [UserController::class, 'getById']);
    Route::post('/admins/{id}', [UserController::class, 'editById']);
    Route::delete('/admins/{id}', [UserController::class, 'deleteById']);
    Route::delete('/admins/logout-sessions/{id}', [UserController::class, 'logoutSessions']);
});


Route::get('/tourist-attractions/{id}', [TouristAttractionController::class, 'getOne']);