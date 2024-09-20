<?php

namespace Tests\Feature;

use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_producto_pertenece_a_proveedor_y_categoria()
    {
        // Crear un proveedor
        $proveedor = Proveedor::factory()->create();
        
        // Crear una categoría
        $categoria = Categoria::factory()->create();

        // Crear un producto vinculado a ese proveedor y categoría
        $producto = Producto::factory()->create([
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
        ]);

        // Verificar que el producto pertenece al proveedor
        $this->assertEquals($proveedor->id, $producto->proveedor->id);

        // Verificar que el producto pertenece a la categoría
        $this->assertEquals($categoria->id, $producto->categoria->id);
    }
}