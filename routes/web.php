<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\SalaJuntaController;

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

Route::get('/',  [SalaJuntaController::class, 'index']);

Route::get('/main', [SalaJuntaController::class, 'index']);
Route::get('/salaJuntas/catalogo', [SalaJuntaController::class, 'show']);
Route::get('/salaJuntas/nuevo', [SalaJuntaController::class, 'create']);
Route::post('/salaJuntas/agregar', [SalaJuntaController::class, 'store']);
Route::get('/salaJuntas/editar/{id_sala}', [SalaJuntaController::class, 'edit']);
Route::put('/salaJuntas/actualizar', [SalaJuntaController::class, 'update']);
Route::delete('/salaJuntas/eliminar/{id_sala}', [SalaJuntaController::class, 'delete']);

Route::get('/reservacion/crear/{id_sala}', [ReservacionController::class, 'show']);
Route::get('/horas/{id_hora}/{id_sala}', [ReservacionController::class, 'horasFinal']);
Route::get('/reservacion/tabla/{id_sala}', [ReservacionController::class, 'recargarTablaReservaciones']);
Route::post('/reservacion/agregar', [ReservacionController::class, 'store']);
Route::delete('/reservacion/eliminar/{id_reservacion}', [ReservacionController::class, 'delete']);
