<?php

namespace Database\Factories;

use App\Models\Aduana;
use App\Models\Destino;
use App\Models\Incoterm;
use App\Models\Mercancia;
use App\Models\Modalidad;
use App\Models\Moneda;
use App\Models\Persona;
use App\Models\TerminosPago;
use App\Models\TiposServicio;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cotizacion>
 */
class CotizacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = $this->faker->numberBetween(2020, date('Y'));
        $formattedYear = sprintf("%04d", $year);
        $formattedYear2d=substr($formattedYear, -2);
        $fechaInicio = "{$year}-01-01";
        $fechaFin = "{$year}-12-31";
        $fechaAleatoria = $this->faker->dateTimeBetween($fechaInicio, $fechaFin);
        $fechaAleatoria->format('Y-m-d');
        $fechaAleatoria2 = $this->faker->dateTimeBetween($fechaAleatoria, $fechaFin);
        $fechaAleatoria2->format('Y-m-d');
        return [
            'num_documento' => "GSA{$formattedYear2d }-{$this->faker->regexify('[0-9]{3}')}",
            'num_referencia'=> $this->faker->unique()->word(20),
            'fecha'=>$fechaAleatoria,            
            'moneda_id' => Moneda::all()->random()->id,
            'mercancia_id' => Mercancia::all()->random()->id,
            'incoterm_id' => Incoterm::all()->random()->id,
            'tipo_servicio_id' => TiposServicio::all()->random()->id,
            'aduana_id' => Aduana::all()->random()->id,
            'lugar_embarque_id' => Destino::all()->random()->id,
            'lugar_entrega_id' => Destino::all()->random()->id,
            'termino_pago_id' => TerminosPago::all()->random()->id,
            'modalidad_id' => Modalidad::all()->random()->id,
            'persona_id' => Persona::all()->random()->id,
            'fecha_valida' => $fechaAleatoria2,
            'periodo_sys' => $formattedYear,
            'notas' => $this->faker->text(100),
            'tc_hnd' =>  $this->faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 25),
            'tc_usd' =>  $this->faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 0.5),
            'total' =>  $this->faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 50000),
            //'moneda_id' => Moneda::all()->random()->id,
        ];
    }
}
