@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Modulo Proveedores') <!-- Cambia el título de la página -->

@section('content')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Proveedores</li>
    </ol>

    <a href="{{ route('proveedores.registrar') }}" class="btn btn-primary mb-2">
        <i class="fas fa-plus"></i> Nuevo Proveedor
    </a>
    <table class="table" id="tblProveedores">
        <thead class="thead-dark">
            <tr class="bg-dark">
                <th class="text-white">Id</th>
                <th class="text-white">RUC</th>
                <th class="text-white">Nombre</th>
                <th class="text-white">Telefono</th>
                <th class="text-white">Direccion</th>
                <th class="text-white">Estado</th>
                <th class="text-white">Acciones</th>
            </tr>
        </thead>

        <tbody>

            @foreach($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->id }}</td>
                <td>{{ $proveedor->ruc }}</td>
                <td>{{ $proveedor->nombre }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ $proveedor->direccion }}</td>
                <td>{{ $proveedor->estado }}</td>
                <td>
                    @if($proveedor->estado == 'Activo')
                        <a href="{{ route('proveedores.editar', $proveedor->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{ route('proveedores.eliminar', $proveedor->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres marcar este proveedor como inactivo?');">Eliminar</a>
                    @else
                        <a href="{{ route('proveedores.reingresar', $proveedor->id) }}" class="btn btn-sm btn-success">Reingresar</a>
                    @endif
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
@endsection