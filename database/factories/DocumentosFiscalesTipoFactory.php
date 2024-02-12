<?php

namespace Database\Factories;

use App\Models\ValueType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentosFiscalesTipo>
 */
class DocumentosFiscalesTipoFactory extends Factory
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
            'value_type_id' => ValueType::all()->random()->id,
        ];
    }
}
