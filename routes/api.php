<?php

use App\Http\Controllers\CartaControlador;
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

Route::get('/cartas', [CartaControlador::class, 'index']);
Route::get('/cartas/{id}', [CartaControlador::class, 'edit']);
Route::get('/cartas/ref/{ref}', [CartaControlador::class, 'obtenerPorRef']);
Route::post('/cartas', [CartaControlador::class, 'store']);
Route::put('/cartas/{id}', [CartaControlador::class, 'update']);
Route::delete('/cartas/{id}', [CartaControlador::class, 'destroy']);
