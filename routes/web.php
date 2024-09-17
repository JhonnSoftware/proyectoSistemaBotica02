<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return "Bienvenido a la pagina principal";
});

Route::get('ventas', function () {
    return "Bienvenido a la modulo ventas";
});

Route::get('ventas/registrarVenta', function () {
    return "En esta pagina se registrara una venta";
});

Route::get('ventas/registrarDetalleVenta', function () {
    return "En esta pagina se registrara un detalle de venta";
});

Route::get('ventas/generarVoucherVenta', function () {
    return "En esta pagina se creara un voucher de venta";
});

Route::get('ventas/anularVenta', function () {
    return "En esta pagina se podra anular una venta";
});

Route::get('compras', function () {
    return "Bienvenido a la pagina principal";
});

Route::get('compras/registrarCompra', function () {
    return "En esta pagina se registrara una compra";
});

Route::get('compras/registrarDetalleCompra', function () {
    return "En esta pagina se registrara un detalle de compra";
});

Route::get('compras/generarVoucherCompra', function () {
    return "En esta pagina se creara un voucher de compra";
});

Route::get('compras/anularCompra', function () {
    return "En esta pagina se podra anular una venta";
});
