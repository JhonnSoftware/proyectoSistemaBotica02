<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClienteController extends Controller
{
    public function index(){
        // Solo mostrar clientes activos
        $clientes = Clientes::all();
        return view('clientes.index', compact('clientes'));
    }

    public function registrarClientes(){
        return view('clientes.registrarClientes');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required',
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'estado' => 'required',
        ]);
        
        Clientes::create([
            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
        ]);

        return redirect()->route('clientes.registrar')->with('success', 'Cliente ingresado correctamente');
    }

    public function eliminarCliente($id)
    {
        // Cambiar el estado a "Inactivo" en lugar de eliminar
        $cliente = Clientes::findOrFail($id);
        $cliente->update(['estado' => 'Inactivo']);

        return redirect()->route('clientes.index')->with('success', 'Cliente marcado como inactivo');
    }

    public function reingresarCliente($id)
    {
        // Cambiar el estado a "Activo"
        $cliente = Clientes::findOrFail($id);
        $cliente->update(['estado' => 'Activo']);

        return redirect()->route('clientes.index')->with('success', 'Cliente reingresado correctamente');
    }

    public function editarCliente($id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('clientes.editarClientes', compact('cliente'));
    }

    public function actualizarCliente(Request $request, $id)
    {
        $request->validate([
            'dni' => 'required',
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'estado' => 'required',
        ]);

        $cliente = Clientes::findOrFail($id);
        $cliente->update([
            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
    }
}
