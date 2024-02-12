<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonaExoneracion>
 */
class PersonaExoneracionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->unique(true); // Limpia la caché de Faker
        $name=$this->faker->unique()->word(5);
        
        $year = $this->faker->numberBetween(2020, date('Y'));

        $fechaInicio = "{$year}-01-01";
        $fechaFin = "{$year}-12-31";
        $fechaAleatoria = $this->faker->dateTimeBetween($fechaInicio, $fechaFin);
        return [
            'registro' =>$name,
            'status' => $this->faker->randomElement([1, 2]),
            'fecha_vencimiento' =>$fechaAleatoria
        ];
    }
}