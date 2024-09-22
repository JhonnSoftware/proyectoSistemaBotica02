<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes; // Importa el modelo

class ClienteController extends Controller
{
    public function index(){

        // Obtener todos los clientes de la base de datos
        $clientes = Clientes::all();

        // Pasar los clientes a la vista
        return view('clientes.index', compact('clientes'));
    }

    public function registrarClientes(){
        return view('clientes.registrarClientes');
    }
    
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'dni' => 'required', // El DNI debe ser único
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'estado' => 'required',
        ]);
        
        // Crear un nuevo cliente en la base de datos
        Clientes::create([
            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
        ]);

        // Redirigir a una página con un mensaje de éxito
        return redirect()->route('clientes.registrar')->with('success', 'Cliente ingresado correctamente');
    }

    public function eliminarCliente(){
        return view('clientes.eliminarClientes');
    }

}
