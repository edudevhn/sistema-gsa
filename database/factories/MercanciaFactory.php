<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mercancia>
 */
class MercanciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name=$this->faker->unique()->word(20);
        return [
            'name'=>$name,
            'registro_partida'=>$this->faker->unique()->word(15),
            'status' => $this->faker->randomElement([1, 2]),
        ];
    }
}
