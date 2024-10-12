<?php

namespace Tests\Feature;

use App\Models\Producto;
use App\Models\Proveedores;
use App\Models\Categorias;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CRUDExitosoProductosTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test para verificar que se puede registrar un producto.
     */
    public function test_registro_exitoso_de_producto()
    {
        // Crear un proveedor y una categoría de prueba
        $proveedor = Proveedores::factory()->create();
        $categoria = Categorias::factory()->create();

        $data = [
            'codigo' => 'PROD123',
            'descripcion' => 'Producto de prueba',
            'precio_compra' => 10.50,
            'precio_venta' => 15.00,
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear un producto
        $response = $this->post(route('productos.store'), $data);

        // Verificar que el producto fue creado exitosamente
        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseHas('productos', $data);
    }

    /**
     * Test para verificar que se puede actualizar un producto.
     */
    public function test_actualizacion_exitosa_de_producto()
    {
        // Crear un proveedor, una categoría y un producto de prueba
        $proveedor = Proveedores::factory()->create();
        $categoria = Categorias::factory()->create();
        $producto = Producto::factory()->create([
            'codigo' => 'PROD123',
            'descripcion' => 'Producto Test',
            'precio_compra' => 10.50,
            'precio_venta' => 15.00,
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Activo',
        ]);

        // Datos actualizados
        $data = [
            'codigo' => 'PROD456',
            'descripcion' => 'Producto Actualizado',
            'precio_compra' => 12.00,
            'precio_venta' => 18.00,
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para actualizar el producto
        $response = $this->post(route('productos.actualizar', $producto->id), $data);

        // Verificar que el producto fue actualizado exitosamente
        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseHas('productos', $data);
    }

    /**
     * Test para verificar que se puede marcar un producto como inactivo.
     */
    public function test_eliminacion_logica_de_producto()
    {
        // Crear un producto de prueba
        $producto = Producto::factory()->create([
            'estado' => 'Activo',
        ]);

        // Ejecutar la petición para marcar el producto como inactivo
        $response = $this->get(route('productos.eliminar', $producto->id));

        // Verificar que el estado del producto es ahora "Inactivo"
        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseHas('productos', [
            'id' => $producto->id,
            'estado' => 'Inactivo',
        ]);
    }

    /**
     * Test para verificar que se puede reingresar un producto.
     */
    public function test_reingreso_de_producto()
    {
        // Crear un producto inactivo
        $producto = Producto::factory()->create([
            'estado' => 'Inactivo',
        ]);

        // Ejecutar la petición para reingresar el producto
        $response = $this->get(route('productos.reingresar', $producto->id));

        // Verificar que el estado del producto es ahora "Activo"
        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseHas('productos', [
            'id' => $producto->id,
            'estado' => 'Activo',
        ]);
    }
}
