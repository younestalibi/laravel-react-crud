<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GestionController;

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

Route::post('/register', [ AuthController::class, 'register']);
Route::post('/login', [ AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', [ AuthController::class, 'user']);
    Route::post('/logout', [ AuthController::class, 'logout']);
});



Route::get('/show', [App\Http\Controllers\GestionController::class, 'index']);
Route::post('/create', [App\Http\Controllers\GestionController::class, 'create']);
Route::post('/show/{product}', [App\Http\Controllers\GestionController::class, 'show']);
Route::patch('/update/{product}', [App\Http\Controllers\GestionController::class, 'update']);
Route::delete('/destroy/{product}', [App\Http\Controllers\GestionController::class, 'destroy']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
