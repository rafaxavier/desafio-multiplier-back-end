<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('/v1/cardapios', 'App\Http\Controllers\CardapioController');
Route::apiResource('/v1/mesas', 'App\Http\Controllers\MesaController');
Route::apiResource('/v1/clientes', 'App\Http\Controllers\ClienteController');