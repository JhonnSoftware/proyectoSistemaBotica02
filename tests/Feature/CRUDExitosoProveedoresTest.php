<?php

namespace Tests\Feature;

use App\Models\Proveedores;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CRUDExitosoProveedoresTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test para verificar que se puede registrar un proveedor.
     */
    public function test_registro_exitoso_de_proveedor()
    {
        $data = [
            'ruc' => '12345678901',
            'nombre' => 'Proveedor Test',
            'telefono' => '987654321',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear un proveedor
        $response = $this->post(route('proveedores.store'), $data);

        // Verificar que el proveedor fue creado exitosamente
        $response->assertRedirect(route('proveedores.registrar'));
        $this->assertDatabaseHas('proveedores', $data);
    }

    /**
     * Test para verificar que se puede actualizar un proveedor.
     */
    public function test_actualizacion_exitosa_de_proveedor()
    {
        // Crear un proveedor de prueba
        $proveedor = Proveedores::factory()->create([
            'ruc' => '12345678901',
            'nombre' => 'Proveedor Test',
            'telefono' => '987654321',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ]);

        // Datos actualizados
        $data = [
            'ruc' => '09876543210',
            'nombre' => 'Proveedor Actualizado',
            'telefono' => '123456789',
            'direccion' => 'Avenida Real 456',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para actualizar el proveedor
        $response = $this->post(route('proveedores.actualizar', $proveedor->id), $data);

        // Verificar que el proveedor fue actualizado exitosamente
        $response->assertRedirect(route('proveedores.index'));
        $this->assertDatabaseHas('proveedores', $data);
    }

    /**
     * Test para verificar que se puede marcar un proveedor como inactivo.
     */
    public function test_eliminacion_logica_de_proveedor()
    {
        // Crear un proveedor de prueba
        $proveedor = Proveedores::factory()->create([
            'estado' => 'Activo',
        ]);

        // Ejecutar la petición para marcar el proveedor como inactivo
        $response = $this->get(route('proveedores.eliminar', $proveedor->id));

        // Verificar que el estado del proveedor es ahora "Inactivo"
        $response->assertRedirect(route('proveedores.index'));
        $this->assertDatabaseHas('proveedores', [
            'id' => $proveedor->id,
            'estado' => 'Inactivo',
        ]);
    }

    /**
     * Test para verificar que se puede reingresar un proveedor.
     */
    public function test_reingreso_de_proveedor()
    {
        // Crear un proveedor inactivo
        $proveedor = Proveedores::factory()->create([
            'estado' => 'Inactivo',
        ]);

        // Ejecutar la petición para reingresar el proveedor
        $response = $this->get(route('proveedores.reingresar', $proveedor->id));

        // Verificar que el estado del proveedor es ahora "Activo"
        $response->assertRedirect(route('proveedores.index'));
        $this->assertDatabaseHas('proveedores', [
            'id' => $proveedor->id,
            'estado' => 'Activo',
        ]);
    }
}
