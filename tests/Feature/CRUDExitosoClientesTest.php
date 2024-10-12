<?php

namespace Tests\Feature;

use App\Models\Clientes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CRUDExitosoClientesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test para crear un cliente exitosamente.
     */
    public function test_crear_cliente_exitosamente()
    {
        // Datos de cliente
        $clienteData = [
            'dni' => '12345678',
            'nombre' => 'Juan Perez',
            'telefono' => '987654321',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo'
        ];

        // Hacer POST a la ruta de creación
        $response = $this->post(route('clientes.store'), $clienteData);

        // Verificar que se redirige correctamente
        $response->assertRedirect(route('clientes.registrar'));

        // Verificar que el cliente está en la base de datos
        $this->assertDatabaseHas('clientes', $clienteData);
    }

    /**
     * Test para editar un cliente exitosamente.
     */
    public function test_editar_cliente_exitosamente()
    {
        // Crear cliente de prueba
        $cliente = Clientes::factory()->create([
            'dni' => '12345678',
            'nombre' => 'Juan Perez',
            'telefono' => '987654321',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo'
        ]);

        // Nuevos datos para actualizar
        $nuevosDatos = [
            'dni' => '87654321',
            'nombre' => 'Carlos Ramirez',
            'telefono' => '123456789',
            'direccion' => 'Avenida Siempre Viva 742',
            'estado' => 'Activo'
        ];

        // Hacer POST para actualizar
        $response = $this->post(route('clientes.actualizar', $cliente->id), $nuevosDatos);

        // Verificar que se redirige correctamente
        $response->assertRedirect(route('clientes.index'));

        // Verificar que el cliente ha sido actualizado en la base de datos
        $this->assertDatabaseHas('clientes', $nuevosDatos);
    }

    /**
     * Test para marcar un cliente como inactivo.
     */
    public function test_eliminar_cliente_exitosamente()
    {
        // Crear cliente de prueba
        $cliente = Clientes::factory()->create([
            'dni' => '12345678',
            'nombre' => 'Juan Perez',
            'telefono' => '987654321',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo'
        ]);

        // Marcar cliente como inactivo
        $response = $this->get(route('clientes.eliminar', $cliente->id));

        // Verificar que se redirige correctamente
        $response->assertRedirect(route('clientes.index'));

        // Verificar que el cliente está marcado como inactivo en la base de datos
        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'estado' => 'Inactivo'
        ]);
    }

    /**
     * Test para reingresar un cliente exitosamente.
     */
    public function test_reingresar_cliente_exitosamente()
    {
        // Crear cliente de prueba
        $cliente = Clientes::factory()->create([
            'dni' => '12345678',
            'nombre' => 'Juan Perez',
            'telefono' => '987654321',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Inactivo'
        ]);

        // Reingresar cliente
        $response = $this->get(route('clientes.reingresar', $cliente->id));

        // Verificar que se redirige correctamente
        $response->assertRedirect(route('clientes.index'));

        // Verificar que el cliente ha sido reingresado como activo en la base de datos
        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'estado' => 'Activo'
        ]);
    }
}
