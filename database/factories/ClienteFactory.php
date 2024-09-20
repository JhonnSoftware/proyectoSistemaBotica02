<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition()
    {
        return [
            'dni' => $this->faker->unique()->numerify('########'),
            'nombre' => $this->faker->name,
            'telefono' => $this->faker->phoneNumber,
            'direccion' => $this->faker->address,
            'estado' => 1, // Activo por defecto
        ];
    }
}
