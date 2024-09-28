<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificarIngresoDatosClientesTest extends TestCase
{
    use RefreshDatabase;

    public function test_cliente_store_with_valid_data()
    {
        $data = [
            'dni' => '12345678',
            'nombre' => 'Juan Pérez',
            'telefono' => '999999999',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ];

        // Simular una solicitud POST al método store
        $this->post('/clientes', $data)
            ->assertStatus(302);  // Verifica que la redirección sea correcta

        // Verificar que el cliente se haya insertado en la base de datos
        $this->assertDatabaseHas('clientes', [
            'dni' => '12345678',
            'nombre' => 'Juan Pérez',
            'telefono' => '999999999',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ]);
    }

    public function test_cliente_store_with_missing_fields()
    {
        // Enviar la solicitud sin el campo 'dni'
        $data = [
            'nombre' => 'Juan Pérez',
            'telefono' => '999999999',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ];

        // Hacer la solicitud POST y verificar que sea redirigido debido a la validación fallida
        $response = $this->post('/clientes', $data);

        // Verificar que la validación haya fallado en el campo 'dni'
        $response->assertSessionHasErrors(['dni']);

        // Verificar que los datos no se insertaron en la base de datos
        $this->assertDatabaseMissing('clientes', ['nombre' => 'Juan Pérez']);
    }
}
