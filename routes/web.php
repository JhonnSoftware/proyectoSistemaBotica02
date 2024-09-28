<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', HomeController::class)->name('home');

Route::controller(ClienteController::class)->group(function(){
    Route::get('clientes', 'index')->name('clientes.index');
    Route::get('clientes/registrarClientes', 'registrarClientes')->name('clientes.registrar');
    Route::post('clientes', 'store')->name('clientes.store'); // Ruta para guardar el cliente

    Route::get('clientes/eliminarCliente/{id}', 'eliminarCliente')->name('clientes.eliminar'); // Ruta para eliminar
    Route::get('clientes/reingresarCliente/{id}', 'reingresarCliente')->name('clientes.reingresar');

    Route::get('clientes/editarCliente/{id}', 'editarCliente')->name('clientes.editar'); // Ruta para editar formulario
    Route::post('clientes/actualizarCliente/{id}', 'actualizarCliente')->name('clientes.actualizar'); // Ruta para actualizar
});

Route::controller(ProveedoresController::class)->group(function(){
    Route::get('proveedores', 'index')->name('proveedores.index');
    Route::get('proveedores/registrarProveedores', 'registrarProveedores')->name('proveedores.registrar');
    Route::post('proveedores', 'store')->name('proveedores.store');

    Route::get('proveedores/eliminarProveedor/{id}', 'eliminarProveedor')->name('proveedores.eliminar'); // Ruta para eliminar
    Route::get('proveedores/reingresarProveedor/{id}', 'reingresarProveedor')->name('proveedores.reingresar');

    Route::get('proveedores/editarProveedor/{id}', 'editarProveedor')->name('proveedores.editar'); // Ruta para editar formulario
    Route::post('proveedores/actualizarProveedor/{id}', 'actualizarProveedor')->name('proveedores.actualizar'); // Ruta para actualizar
});

Route::controller(CategoriasController::class)->group(function(){
    Route::get('categorias', 'index')->name('categorias.index'); 
    Route::get('categorias/registrarCategorias', 'registrarCategorias')->name('categorias.registrar');
    Route::post('categorias', 'store')->name('categorias.store'); // Ruta para guardar el cliente

    Route::get('categorias/eliminarCategoria/{id}', 'eliminarCategoria')->name('categorias.eliminar'); // Ruta para eliminar
    Route::get('categorias/reingresarCategoria/{id}', 'reingresarCategoria')->name('categorias.reingresar');

    Route::get('categorias/editarCategoria/{id}', 'editarCategoria')->name('categorias.editar'); // Ruta para editar formulario
    Route::post('categorias/actualizarCategoria/{id}', 'actualizarCategoria')->name('categorias.actualizar'); // Ruta para actualizar
});

Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index')->name('users.index');
    Route::get('users/registrarUsers', 'registrarUsers')->name('users.registrar');
    Route::post('users', 'store')->name('users.store');

    Route::get('users/eliminarUser/{id}', 'eliminarUser')->name('users.eliminar'); // Ruta para eliminar

    Route::get('users/editarUser/{id}', 'editarUser')->name('users.editar'); // Ruta para editar formulario
    Route::post('users/actualizarUser/{id}', 'actualizarUser')->name('users.actualizar'); // Ruta para actualizar
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
