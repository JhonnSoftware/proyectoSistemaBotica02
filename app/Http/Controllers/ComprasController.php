<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComprasController extends Controller
{
    //Metodo para mostrar la pagina principal de las compras
    public function index(){
        return view('compras.index');
    }
    //Metodo para registrar la compra
    public function registrarCompra(){
        return view('compras.registrarCompra');
    }
    //Metodo para registrar el detalle de compra
    public function registrarDetalleCompra(){
        return view('compras.registrarDetalleCompra');
    }
    //Metodo para generar un voucher de la compra creada
    public function generarVoucherCompra(){
        return view('compras.generarVoucherCompra');
    }
    //Metodo para anular una compra
    public function anularCompra(){
        return view('compras.anularCompra');
    }
}