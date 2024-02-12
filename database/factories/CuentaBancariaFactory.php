<?php

namespace Database\Factories;

use App\Models\Banco;
use App\Models\Moneda;
use App\Models\TipoCuenta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CuentaBancaria>
 */
class CuentaBancariaFactory extends Factory
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
            'num_cuenta' => $this->faker->text(250),
            'predeterminada' =>$this->faker->randomElement([1, 2]),
            'moneda_id' => Moneda::all()->random()->id,
            'banco_id' => Banco::all()->random()->id,
            'tipo_cuenta_id' => TipoCuenta::all()->random()->id,
        ];
    }
}
