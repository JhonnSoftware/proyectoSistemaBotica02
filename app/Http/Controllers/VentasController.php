<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentasController extends Controller
{
    
    //Metodo para mostrar la pagina principal de las ventas
    public function index(){
        return "Bienvenido al modulo de ventas";
    }
    //Metodo para registrar la venta
    public function registrarVenta(){
        return "En esta pagina podras registrar una venta";
    }
    //Metodo para registrar el detalle de venta
    public function registrarDetalleVenta(){
        return "En esta pagina podras registrar un detalle de venta";
    }
    //Metodo para generar un voucher de la venta creada
    public function generarVoucherVenta(){
        return "En esta pagina podras generar un voucher de la venta realizada";
    }
    //Metodo para anular una venta
    public function anularVenta(){
        return "En esta pagina podras anular una venta";
    }
    

}
