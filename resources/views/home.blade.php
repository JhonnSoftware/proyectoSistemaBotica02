@extends('layouts.plantilla')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary">
                <div class="card-body d-flex text-white">
                    Usuarios
                    <i class="fas fa-user fa-2x ml-auto"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('users.index') }}" class="text-white">Ver Detalle</a> <!-- Enlace a usuarios -->
                    <span class="text-white">{{ $totalUsuarios }}</span> <!-- Mostrar el total de usuarios -->
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
                    <a href="{{ route('clientes.index') }}" class="text-white">Ver Detalle</a> <!-- Enlace a clientes -->
                    <span class="text-white">{{ $totalClientes }}</span> <!-- Mostrar el total de clientes -->
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
                    <a href="{{ route('productos.index') }}" class="text-white">Ver Detalle</a> <!-- Enlace a productos -->
                    <span class="text-white">{{ $totalProductos }}</span> <!-- Mostrar el total de productos -->
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
                    <a href="{{ route('ventas.index') }}" class="text-white">Ver Ventas</a> <!-- Enlace a ventas -->
                    <span class="text-white">S/. {{ number_format($ventasHoy, 2) }}</span> <!-- Mostrar el total de ventas del día -->
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <!-- Productos con Stock Minimo -->
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

        <!-- Productos Mas Vendidos -->
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
@section('scripts')
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 <script>
     document.addEventListener('DOMContentLoaded', function () {
            // Gráfico de Productos con Stock Mínimo - Tipo Pie
            var ctxStockMinimo = document.getElementById('stockMinimo');
            if (ctxStockMinimo) {
                var stockMinimoChart = new Chart(ctxStockMinimo.getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: [
                            @foreach($productosStockMinimo as $producto)
                                '{{ $producto->descripcion  }}',
                            @endforeach
                        ],
                        datasets: [{
                            label: 'Cantidad',
                            data: [
                                @foreach($productosStockMinimo as $producto)
                                    {{ $producto->cantidad }},
                                @endforeach
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
                });
            }

            var ctxProductosMasVendidos = document.getElementById('ProductosMasVendidos');
            if (ctxProductosMasVendidos) {
                var productosMasVendidosChart = new Chart(ctxProductosMasVendidos.getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: [
                            @foreach($productosMasVendidos as $detalle)
                                '{{ $detalle->producto->descripcion  }}',
                            @endforeach
                        ],
                        datasets: [{
                            label: 'Cantidad Vendida',
                            data: [
                                @foreach($productosMasVendidos as $detalle)
                                    {{ $detalle->total_vendido }},
                                @endforeach
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
                });
            }
        });
 </script>

