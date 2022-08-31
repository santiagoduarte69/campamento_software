<?php

use Illuminate\Http\Request;
use App\Http\Controllers\BootcampController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Primera ruta REST

Route::get('prueba', function(){echo "hola";});

//vincular el controlador bootcamp a sus respectivas rutas
Route::apiResource('bootcamp', BootcampController::class);
