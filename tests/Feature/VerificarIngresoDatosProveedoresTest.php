<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Proveedores;

class VerificarIngresoDatosProveedoresTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test para almacenar un proveedor con datos válidos
     */
    public function test_proveedor_store_with_valid_data()
    {
        // Simulamos una petición POST con datos válidos
        $response = $this->post(route('proveedores.store'), [
            'ruc' => '12345678901',
            'nombre' => 'Proveedor Test',
            'telefono' => '999999999',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ]);

        // Verificamos que la respuesta redirige correctamente (302 indica redirección)
        $response->assertStatus(302);

        // Verificamos que el proveedor se guardó en la base de datos
        $this->assertDatabaseHas('proveedores', [
            'ruc' => '12345678901',
            'nombre' => 'Proveedor Test',
            'telefono' => '999999999',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ]);

        // Verificamos que existe el mensaje de éxito en la sesión
        $response->assertSessionHas('success', 'Proveedor ingresado correctamente');
    }

    /**
     * Test para almacenar un proveedor con campos faltantes
     */
    public function test_proveedor_store_with_missing_fields()
    {
        // Simulamos una petición POST sin enviar todos los campos requeridos
        $response = $this->post(route('proveedores.store'), [
            'ruc' => '', // Campo RUC vacío
            'nombre' => '', // Campo nombre vacío
            'telefono' => '', // Campo teléfono vacío
            'direccion' => '', // Campo dirección vacío
            'estado' => '', // Campo estado vacío
        ]);

        // Verificamos que la respuesta contiene errores de validación para los campos especificados
        $response->assertSessionHasErrors([
            'ruc',
            'nombre',
            'telefono',
            'direccion',
            'estado',
        ]);
    }

    /**
     * Test para almacenar un proveedor con datos inválidos
     */
    public function test_proveedor_store_with_invalid_data()
    {
        // Simulamos una petición POST con un estado inválido (no es "Activo" o "Inactivo")
        $response = $this->post(route('proveedores.store'), [
            'ruc' => '12345678901',
            'nombre' => 'Proveedor Test',
            'telefono' => '999999999',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'No Activo', // Estado inválido
        ]);

        // Verificamos que la respuesta contiene un error de validación para el campo estado
        $response->assertSessionHasErrors(['estado']);
    }
}
