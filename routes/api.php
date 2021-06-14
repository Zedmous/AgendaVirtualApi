<?php

use App\Http\Controllers\ContactoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('contactos', [ContactoController::class,'index']);
Route::get('contactos/{id}', [ContactoController::class,'show']);
Route::post('contactos', [ContactoController::class,'store']);
Route::put('contactos/{id}', [ContactoController::class,'update']);
Route::delete('contactos/{id}', [ContactoController::class,'destroy']);