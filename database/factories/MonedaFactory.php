<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Moneda>
 */
class MonedaFactory extends Factory
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
            'tasa_cambio' =>  $this->faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 25),
        ];
    }
}
