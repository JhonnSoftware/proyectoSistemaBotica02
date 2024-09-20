<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Venta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    use RefreshDatabase; // Esto se asegura de que tu base de datos se reinicie para cada prueba

    /** @test */
    public function test_cliente_tiene_ventas()
    {
        // Crear un cliente
        $cliente = Cliente::factory()->create();
        
        // Crear una venta asociada al cliente
        $venta = Venta::factory()->create(['id_cliente' => $cliente->id]);

        // Verificar que el cliente tenga la venta
        $this->assertTrue($cliente->ventas->contains($venta));
    }
}