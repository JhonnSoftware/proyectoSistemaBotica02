<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function proveedor() {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
