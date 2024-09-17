<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComprasController extends Controller
{
    
    //Metodo para mostrar la pagina principal de las compras
    public function index(){
        return "Bienvenido al modulo de compras";
    }
    //Metodo para registrar la compra
    public function registrarCompra(){
        return "En esta pagina podras registrar una compra";
    }
    //Metodo para registrar el detalle de compra
    public function registrarDetalleCompra(){
        return "En esta pagina podras registrar un detalle de compra";
    }
    //Metodo para generar un voucher de la compra creada
    public function generarVoucherCompra(){
        return "En esta pagina podras generar un voucher de la compra realizada";
    }
    //Metodo para anular una compra
    public function anularCompra(){
        return "En esta pagina podras anular una compra";
    }

}
