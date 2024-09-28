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

    public function registrarProveedores(){
        return view('proveedores.registrarProveedores');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'ruc' => 'required|digits:11|numeric',
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        // Crear un nuevo proveedor en la base de datos
        Proveedores::create([
            'ruc' => $request->ruc,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
        ]);

        // Redirigir a una página con un mensaje de éxito
        return redirect()->route('proveedores.registrar')->with('success', 'Proveedor ingresado correctamente');
    }

    public function eliminarProveedor($id)
    {
        // Cambiar el estado a "Inactivo" en lugar de eliminar
        $proveedor = Proveedores::findOrFail($id);
        $proveedor->update(['estado' => 'Inactivo']);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor marcado como inactivo');
    }

    public function reingresarProveedor($id)
    {
        // Cambiar el estado a "Activo"
        $proveedor = Proveedores::findOrFail($id);
        $proveedor->update(['estado' => 'Activo']);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor reingresado correctamente');
    }

    public function editarProveedor($id)
    {
        $proveedor = Proveedores::findOrFail($id);
        return view('proveedores.editarProveedores', compact('proveedor'));
    }

    public function actualizarProveedor(Request $request, $id)
    {
        $request->validate([
            'ruc' => 'required',
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'estado' => 'required',
        ]);

        $proveedor = Proveedores::findOrFail($id);
        $proveedor->update([
            'ruc' => $request->ruc,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
        ]);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente');
    }

}
