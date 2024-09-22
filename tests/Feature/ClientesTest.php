<?php

namespace Tests\Feature;

use App\Models\Clientes;
use App\Models\Venta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientesTest extends TestCase
{
    use RefreshDatabase; // Esto se asegura de que tu base de datos se reinicie para cada prueba

    /** @test */
    public function test_cliente_tiene_ventas()
    {
        // Crear un cliente
        $cliente = Clientes::factory()->create();
        
        // Crear una venta asociada al cliente
        $venta = Venta::factory()->create(['id_cliente' => $cliente->id]);

        // Verificar que el cliente tenga la venta
        $this->assertTrue($cliente->ventas->contains($venta));
    }
}