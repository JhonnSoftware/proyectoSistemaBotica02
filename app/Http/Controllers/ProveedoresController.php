<?php

namespace App\Http\Controllers;
use App\Models\Proveedores; // Importa el modelo

use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    public function index(){

        // Obtener todos los clientes de la base de datos
        $proveedores = Proveedores::all();

        // Pasar los clientes a la vista
        return view('proveedores.index', compact('proveedores'));
    }
}
