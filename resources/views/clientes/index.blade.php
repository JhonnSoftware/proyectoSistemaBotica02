@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Modulo Clientes') <!-- Cambia el título de la página -->

@section('content')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Clientes</li>
    </ol>

    <a href="{{ route('clientes.registrar') }}" class="btn btn-primary mb-2">
        <i class="fas fa-plus"></i> Nuevo Cliente
    </a>

    <!-- Aquí está tu tabla -->
    <table class="table" id="tblClientes">
        <thead class="thead-dark">
            <tr class="bg-dark">
                <th class="text-white">Id</th>
                <th class="text-white">DNI</th>
                <th class="text-white">Nombre</th>
                <th class="text-white">Telefono</th>
                <th class="text-white">Direccion</th>
                <th class="text-white">Estado</th>
                <th class="text-white">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->dni }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->direccion }}</td>
                <td>{{ $cliente->estado }}</td>
                <td>
                    @if($cliente->estado == 'Activo')
                        <a href="{{ route('clientes.editar', $cliente->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{ route('clientes.eliminar', $cliente->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres marcar este cliente como inactivo?');">Eliminar</a>
                    @else
                        <a href="{{ route('clientes.reingresar', $cliente->id) }}" class="btn btn-sm btn-success">Reingresar</a>
                    @endif
                </td>               
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Enlaces de paginación -->
    {{ $clientes->links() }}

@endsection
