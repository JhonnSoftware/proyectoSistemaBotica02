<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class VentasController extends Controller
{
    
    //Metodo para mostrar la pagina principal de las ventas
    public function index(){
        return view('ventas.index');
    }
    //Metodo para registrar la venta
    public function registrarVenta(Request $request){
        /*
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'id_cliente' => 'required|integer',
                'total' => 'required|integer',
                'fecha' => 'required|date',
                'estado' => 'required|string'
            ]);
    
            try {
                // Crear la nueva venta en la base de datos
                Venta::create($validatedData);
                
                // Redirigir a la vista con un mensaje de éxito
                return redirect()->route('ventas.index')->with('success', 'Venta creada correctamente');
            } catch (\Exception $e) {
                return redirect()->route('ventas.index')->with('error', 'Error al crear la venta: ' . $e->getMessage());
            }
        }
        */
        return view('ventas.registrarVenta');
    }
    //Metodo para registrar el detalle de venta
    public function registrarDetalleVenta(){
        return view('ventas.registrarDetalleVenta');
    }
    //Metodo para generar un voucher de la venta creada
    public function generarVoucherVenta(){
        return view('ventas.generarVoucherVenta');
    }
    //Metodo para anular una venta
    public function anularVenta(){
        return view('ventas.anularVenta');
    }
    
}