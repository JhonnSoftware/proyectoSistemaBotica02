<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\ClienteController;

Route::get('/', HomeController::class);

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

Route::controller(ClienteController::class)->group(function(){
    Route::get('clientes', 'index')->name('clientes.index');
    Route::get('clientes/registrarClientes', 'registrarClientes')->name('clientes.registrar');
    Route::post('clientes', 'store')->name('clientes.store'); // Ruta para guardar el cliente

    Route::get('clientes/eliminarCliente', 'eliminarCliente');
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
