<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\GestionController;
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
// Route::post('/home/update/image/{user}',  [App\Http\Controllers\ProfileController::class, 'update_image']);

// Route::get('/calcul/{nombreCopie}', [App\Http\Controllers\GestionController::class, 'calcul']);
// Route::get('/moyenne/{nom}/{moyenne}', [App\Http\Controllers\GestionController::class, 'moyenne']);
// Route::get('/notes', [App\Http\Controllers\GestionController::class, 'notes']);


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
