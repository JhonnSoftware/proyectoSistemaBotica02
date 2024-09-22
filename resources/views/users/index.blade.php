@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Modulo Usuarios') <!-- Cambia el título de la página -->

@section('content')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Usuarios</li>
    </ol>
    <a href="" class="btn btn-primary mb-2">
        <i class="fas fa-plus"></i> Nuevo Usuario
    </a>

    <table class="table" id="tblUsuarios">
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

        </tbody>
    </table>

@endsection