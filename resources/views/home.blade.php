@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Home') <!-- Cambia el título de la página -->

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary">
                <div class="card-body d-flex text-white">
                    Usuarios
                    <i class="fas fa-user fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="" class="text-white">Ver Detalle</a>
                    <span class="text-white"></span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success">
                <div class="card-body d-flex text-white">
                    Clientes
                    <i class="fas fa-users fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="" class="text-white">Ver Detalle</a>
                    <span class="text-white"></span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger">
                <div class="card-body d-flex text-white">
                    Productos
                    <i class="fab fa-product-hunt fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="" class="text-white">Ver Detalle</a>
                    <span class="text-white"></span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card" style="background-color: orange;">
                <div class="card-body d-flex text-white">
                    Ventas del Día
                    <i class="fas fa-shopping-cart fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="" class="text-white">Ver Ventas</a>
                    <span class="text-white"></span>
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-2">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Productos con Stock Minimo
                </div>
                <div class="card-body">
                    <canvas id="stockMinimo"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Productos Mas Vendidos
                </div>
                <div class="card-body">
                    <canvas id="ProductosMasVendidos"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection