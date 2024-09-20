<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    protected $model = Proveedor::class;

    public function definition()
    {
        return [
            'ruc' => $this->faker->unique()->numerify('###########'), // 11 dígitos en Perú
            'nombre' => $this->faker->company,
            'telefono' => $this->faker->phoneNumber,
            'direccion' => $this->faker->address,
            'estado' => 1, // Activo por defecto
        ];
    }
}