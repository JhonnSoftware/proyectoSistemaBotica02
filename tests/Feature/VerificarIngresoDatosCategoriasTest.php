<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Categorias;

class VerificarIngresoDatosCategoriasTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_store_with_valid_data()
    {
        // Simulamos una petición POST con datos válidos
        $response = $this->post(route('categorias.store'), [
            'nombre' => 'Categoria Test',
            'estado' => 'Activo',
        ]);

        // Verificamos que la respuesta redirige correctamente (302 indica redirección)
        $response->assertStatus(302);

        // Verificamos que la categoría se guardó en la base de datos
        $this->assertDatabaseHas('categorias', [
            'nombre' => 'Categoria Test',
            'estado' => 'Activo',
        ]);

        // Verificamos que existe el mensaje de éxito en la sesión
        $response->assertSessionHas('success', 'Categoria ingresado correctamente');
    }

    public function test_category_store_with_missing_fields()
    {
        // Simulamos una petición POST sin enviar todos los campos requeridos
        $response = $this->post(route('categorias.store'), [
            'nombre' => '', // Campo nombre vacío
            'estado' => '', // Campo estado vacío
        ]);

        // Verificamos que la respuesta contiene errores de validación para los campos especificados
        $response->assertSessionHasErrors([
            'nombre',
            'estado',
        ]);
    }

    public function test_category_store_with_invalid_data()
    {
        // Simulamos una petición POST con datos inválidos (estado no válido)
        $response = $this->post(route('categorias.store'), [
            'nombre' => 'Categoria Test',
            'estado' => 'No Activo', // Estado inválido si hay una validación que lo limita a 'Activo' o 'Inactivo'
        ]);

        // Verificamos que la respuesta contiene un error de validación para el campo estado
        $response->assertSessionHasErrors(['estado']);
    }
}
