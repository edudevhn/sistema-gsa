<?php

namespace Database\Factories;

use App\Models\Cuenta;
use App\Models\Moneda;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servicio>
 */
class ServicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->sentence();        
        return [
            'name' => $name,
            'descripcion' => $this->faker->text(250),
            'status' => $this->faker->randomElement([1, 2]),
            'cuenta_id' => Cuenta::all()->random()->id,
        ];
    }
}