@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Modulo Proveedores') <!-- Cambia el título de la página -->

@section('content')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Proveedores</li>
    </ol>

    <a href="" class="btn btn-primary mb-2">
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
                    <!-- Aquí puedes agregar botones de acciones como editar o eliminar -->
                    <a href="#" class="btn btn-sm btn-warning">Editar</a>
                    <a href="#" class="btn btn-sm btn-danger">Eliminar</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
@endsection