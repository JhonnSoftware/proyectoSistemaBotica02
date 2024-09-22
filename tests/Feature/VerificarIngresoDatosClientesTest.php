<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificarIngresoDatosClientesTest extends TestCase
{
    use RefreshDatabase;

    public function test_cliente_store_with_valid_data()
    {
        // Simulamos una petición POST con datos válidos
        $response = $this->post(route('clientes.store'), [
            'dni' => '12345678',
            'nombre' => 'Juan Pérez',
            'telefono' => '999999999',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ]);

        // Verificamos que la respuesta redirige correctamente (302 indica redirección)
        $response->assertStatus(302);

        // Verificamos que el cliente se guardó en la base de datos
        $this->assertDatabaseHas('clientes', [
            'dni' => '12345678',
            'nombre' => 'Juan Pérez',
            'telefono' => '999999999',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ]);

        // Verificamos que existe el mensaje de éxito en la sesión
        $response->assertSessionHas('success', 'Cliente ingresado correctamente');
    }

    public function test_cliente_store_with_missing_fields()
    {
    // Simulamos una petición POST sin enviar todos los campos requeridos
    $response = $this->post(route('clientes.store'), [
        'dni' => '', // Falta el campo DNI
        'nombre' => '',
        'telefono' => '',
        'direccion' => '',
        'estado' => '',
    ]);

    // Verificamos que la respuesta contiene errores de validación para los campos especificados
    $response->assertSessionHasErrors([
        'dni',
        'nombre',
        'telefono',
        'direccion',
        'estado',
    ]);
    }
}
