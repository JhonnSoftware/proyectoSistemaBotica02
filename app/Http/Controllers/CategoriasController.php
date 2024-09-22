<?php

namespace App\Http\Controllers;
use App\Models\Categorias; 
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index(){

        // Obtener todos los clientes de la base de datos
        $categorias = Categorias::all();

        // Pasar los clientes a la vista
        return view('categorias.index', compact('categorias'));
    }
}
