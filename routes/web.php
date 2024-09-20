<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ComprasController;

Route::get('/', HomeController::class);


Route::get('/', function () {
    return "Bienvenido a la pagina principal";
});

Route::controller(VentasController::class)->group(function(){
    Route::get('ventas', 'index');
    Route::get('ventas/registrarVenta', 'registrarVenta');
    Route::get('ventas/registrarDetalleVenta', 'registrarDetalleVenta');
    Route::get('ventas/generarVoucherVenta', 'generarVoucherVenta');
    Route::get('ventas/anularVenta', 'anularVenta');
});

Route::controller(ComprasController::class)->group(function(){
    Route::get('compras', 'index');
    Route::get('compras/registrarCompra', 'registrarCompra');
    Route::get('compras/registrarDetalleCompra', 'registrarDetalleCompra');
    Route::get('compras/generarVoucherCompra', 'generarVoucherCompra');
    Route::get('compras/anularCompra', 'anularCompra');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
