<?php

namespace Tests\Feature;

use App\Models\Categorias;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CRUDExitosoCategoriasTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test para verificar que se puede registrar una categoría.
     */
    public function test_registro_exitoso_de_categoria()
    {
        $data = [
            'nombre' => 'Categoría de prueba',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear una categoría
        $response = $this->post(route('categorias.store'), $data);

        // Verificar que la categoría fue creada exitosamente
        $response->assertRedirect(route('categorias.registrar'));
        $this->assertDatabaseHas('categorias', $data);
    }

    /**
     * Test para verificar que se puede actualizar una categoría.
     */
    public function test_actualizacion_exitosa_de_categoria()
    {
        // Crear una categoría de prueba
        $categoria = Categorias::factory()->create([
            'nombre' => 'Categoría Test',
            'estado' => 'Activo',
        ]);

        // Datos actualizados
        $data = [
            'nombre' => 'Categoría Actualizada',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para actualizar la categoría
        $response = $this->post(route('categorias.actualizar', $categoria->id), $data);

        // Verificar que la categoría fue actualizada exitosamente
        $response->assertRedirect(route('categorias.index'));
        $this->assertDatabaseHas('categorias', $data);
    }

    /**
     * Test para verificar que se puede marcar una categoría como inactiva.
     */
    public function test_eliminacion_logica_de_categoria()
    {
        // Crear una categoría de prueba
        $categoria = Categorias::factory()->create([
            'estado' => 'Activo',
        ]);

        // Ejecutar la petición para marcar la categoría como inactiva
        $response = $this->get(route('categorias.eliminar', $categoria->id));

        // Verificar que el estado de la categoría es ahora "Inactivo"
        $response->assertRedirect(route('categorias.index'));
        $this->assertDatabaseHas('categorias', [
            'id' => $categoria->id,
            'estado' => 'Inactivo',
        ]);
    }

    /**
     * Test para verificar que se puede reingresar una categoría.
     */
    public function test_reingreso_de_categoria()
    {
        // Crear una categoría inactiva
        $categoria = Categorias::factory()->create([
            'estado' => 'Inactivo',
        ]);

        // Ejecutar la petición para reingresar la categoría
        $response = $this->get(route('categorias.reingresar', $categoria->id));

        // Verificar que el estado de la categoría es ahora "Activo"
        $response->assertRedirect(route('categorias.index'));
        $this->assertDatabaseHas('categorias', [
            'id' => $categoria->id,
            'estado' => 'Activo',
        ]);
    }
}
