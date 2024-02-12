<?php

namespace Database\Factories;

use App\Models\Aduana;
use App\Models\Consignatario;
use App\Models\Destino;
use App\Models\Embarque;
use App\Models\Frontera;
use App\Models\Incoterm;
use App\Models\Mercancia;
use App\Models\Modalidad;
use App\Models\Moneda;
use App\Models\Persona;
use App\Models\TerminosPago;
use App\Models\TiposServicio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Embarque>
 */
class EmbarqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        
        $year = $this->faker->numberBetween(2020, date('Y'));
        $mes = $this->faker->numberBetween(12, date('m'));
        $formattedYear = sprintf("%04d", $year);
        $mesFormat = sprintf("%02d", $mes);
        $fechaInicio = "{$year}-01-01";
        $fechaFin = "{$year}-12-31";
        $fechaAleatoria = $this->faker->dateTimeBetween($fechaInicio, $fechaFin);
        $fechaAleatoria->format('Y-m-d');
        $fechaAleatoria2 = $this->faker->dateTimeBetween($fechaAleatoria, $fechaFin);
        $fechaAleatoria2->format('Y-m-d');
        do {
            $cadena = "GSA{$year}-{$mesFormat}-{$this->faker->regexify('[0-9]{3}')}";
            // Verificar si la cadena ya existe en la base de datos
            $existeRegistro = Embarque::where('num_embarque', $cadena)->exists();

        } while ($existeRegistro);
        return [
            'num_embarque' => $cadena,
            'fecha'=>$fechaAleatoria,
            'embarcador' => $this->faker->word(10),
            'consignatario' => $this->faker->word(12),
            'fecha_valida' => $fechaAleatoria2,
            'periodo_sys' => $formattedYear,
            'notas' => $this->faker->text(100),
            'mercancia_id' => Mercancia::all()->random()->id,
            'incoterm_id' => Incoterm::all()->random()->id,
            'tipo_servicio_id' => TiposServicio::all()->random()->id,
            'aduana_id' => Aduana::all()->random()->id,
            'lugar_embarque_id' => Destino::all()->random()->id,
            'lugar_entrega_id' => Destino::all()->random()->id,
            'termino_pago_id' => TerminosPago::all()->random()->id,
            'modalidad_id' => Modalidad::all()->random()->id,
            'persona_id' => Persona::all()->random()->id,
            'moneda_id' => Moneda::all()->random()->id,
            //'pol_id' => Frontera::all()->random()->id,
            //'pod_id' => Frontera::all()->random()->id,
        ];
    }
}