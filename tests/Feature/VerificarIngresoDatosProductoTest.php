<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Proveedores;
use App\Models\Categorias;
use App\Models\Producto;

class VerificarIngresoDatosProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_producto_store_with_valid_data()
    {
        // Crear datos de ejemplo para proveedor y categoría
        $proveedor = Proveedores::factory()->create();
        $categoria = Categorias::factory()->create();

        $data = [
            'codigo' => 'PROD001',
            'descripcion' => 'Producto de prueba',
            'precio_compra' => 100.50,
            'precio_venta' => 150.75,
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Activo',
        ];

        // Simular una solicitud POST al método store
        $this->post('/productos', $data)
            ->assertStatus(302);  // Verifica que la redirección sea correcta

        // Verificar que el producto se haya insertado en la base de datos
        $this->assertDatabaseHas('productos', [
            'codigo' => 'PROD001',
            'descripcion' => 'Producto de prueba',
            'precio_compra' => 100.50,
            'precio_venta' => 150.75,
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Activo',
        ]);
    }

    public function test_producto_store_with_missing_fields()
    {
        // Crear datos de ejemplo para proveedor y categoría
        $proveedor = Proveedores::factory()->create();
        $categoria = Categorias::factory()->create();

        // Enviar la solicitud sin el campo 'codigo'
        $data = [
            'descripcion' => 'Producto de prueba',
            'precio_compra' => 100.50,
            'precio_venta' => 150.75,
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Activo',
        ];

        // Hacer la solicitud POST y verificar que sea redirigido debido a la validación fallida
        $response = $this->post('/productos', $data);

        // Verificar que la validación haya fallado en el campo 'codigo'
        $response->assertSessionHasErrors(['codigo']);

        // Verificar que los datos no se insertaron en la base de datos
        $this->assertDatabaseMissing('productos', ['descripcion' => 'Producto de prueba']);
    }
}
