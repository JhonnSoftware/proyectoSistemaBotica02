<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificarIngresoDatosUsuariosTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_store_with_valid_data()
    {
        // Simulamos una petición POST con datos válidos
        $response = $this->post(route('users.store'), [
            'name' => 'Usuario Test',
            'email' => 'testuser@example.com',
            'password' => 'password123', // Contraseña en texto plano
        ]);

        // Verificamos que la respuesta redirige correctamente (302 indica redirección)
        $response->assertStatus(302);

        // Verificamos que el usuario se guardó en la base de datos
        $this->assertDatabaseHas('users', [
            'name' => 'Usuario Test',
            'email' => 'testuser@example.com',
        ]);

        // Verificamos que existe el mensaje de éxito en la sesión
        $response->assertSessionHas('success', 'Usuario creado correctamente');
    }

    public function test_user_store_with_missing_fields()
    {
        // Simulamos una petición POST sin enviar todos los campos requeridos
        $response = $this->post(route('users.store'), [
            'name' => '', // Campo name vacío
            'email' => '', // Campo email vacío
            'password' => '', // Campo password vacío
        ]);

        // Verificamos que la respuesta contiene errores de validación para los campos especificados
        $response->assertSessionHasErrors([
            'name',
            'email',
            'password',
        ]);
    }

    public function test_user_store_with_invalid_email()
    {
        // Simulamos una petición POST con un email inválido
        $response = $this->post(route('users.store'), [
            'name' => 'Usuario Test',
            'email' => 'email-invalido', // Email inválido
            'password' => 'password123',
        ]);

        // Verificamos que la respuesta contiene un error de validación para el email
        $response->assertSessionHasErrors(['email']);
    }
}
