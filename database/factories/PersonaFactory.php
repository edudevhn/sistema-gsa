<?php

namespace Database\Factories;

use App\Models\Entidad;
use App\Models\TiposPersona;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->sentence();
        $rtn = $this->faker->regexify('[0-9]{13}');
        
        return [
            'name' => $name,
            'rtn' => $rtn.$this->faker->regexify('[0-9]{1}'),
            'telefono' => $this->faker->regexify('[0-9]{8}'),
            'email' => $this->faker->safeEmail(),
            'direccion_fiscal' => $this->faker->text(250),
            'entidad_id' => Entidad::all()->random()->id,
            'tipo_persona_id' => TiposPersona::all()->random()->id,
            'exonerado' => $this->faker->randomElement([1, 2]),
        ];
    }
}