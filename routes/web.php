<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetalleVentaController;

Route::get('/', function () {
    return redirect()->route('libros.index');
});


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('libros', LibroController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('autores', AutorController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('ventas', VentaController::class);
Route::resource('detalles', DetalleVentaController::class);
Route::get('detalle-venta/{id}', [DetalleVentaController::class, 'index'])->name('detalle_venta.index');
Route::get('/reporte-ventas', [VentaController::class, 'ObtenerReporteVentas'])->name('ventas.report');
Route::get('/reporte-clientes-frecuentes', [ClienteController::class, 'ReporteClientesFrecuentes'])->name('clientes.report');