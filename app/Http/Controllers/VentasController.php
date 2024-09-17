<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentasController extends Controller
{
    
    //Metodo para mostrar la pagina principal de las ventas
    public function index(){
        return view('ventas.index');
    }
    //Metodo para registrar la venta
    public function registrarVenta(){
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