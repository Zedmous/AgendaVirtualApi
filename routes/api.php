<?php

//use App\Http\Controllers\ContactoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\V1\AuthController;
use \App\Http\Controllers\Api\V1\ContactoController;


Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [AuthController::class, 'me'])->name('me');
   
    
});
Route::apiResource('contactos', ContactoController::class)->middleware('api');
/*Route::post('contactos', [ContactoController::class,'store']);
Route::get('contactos', [ContactoController::class,'index']);
Route::get('contactos/{id}', [ContactoController::class,'show']);
//Route::post('contactos', [ContactoController::class,'store']);
Route::put('contactos/{id}', [ContactoController::class,'update']);
Route::delete('contactos/{id}', [ContactoController::class,'destroy']);*/