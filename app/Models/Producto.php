<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function proveedor() {
        return $this->belongsTo(Proveedores::class, 'id_proveedor');
    }

    public function categoria() {
        return $this->belongsTo(Categorias::class, 'id_categoria');
    }

    protected $fillable = [
        'codigo', 
        'descripcion', 
        'precio_compra', 
        'precio_venta', 
        'cantidad', 
        'id_proveedor', 
        'id_categoria',
        'estado'
    ];

    // Valor por defecto para el campo cantidad
    protected $attributes = [
        'cantidad' => 0,
    ];
}
