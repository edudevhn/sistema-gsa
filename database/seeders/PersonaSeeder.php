<?php

namespace Database\Seeders;

use App\Models\Entidad;
use App\Models\Persona;
use App\Models\PersonaExoneracion;
use App\Models\TerminosPago;
use App\Models\TiposPersona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
class PersonaSeeder extends Seeder
{


    protected $faker ;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $persona1 =new Persona();
        $persona1->name ='BIJAO ELECTRIC COMPANY S.A. DE C.V.';
        $persona1->rtn ='05019004463363';
        $persona1->telefono ='999999999';
        $persona1->email ='asdf@asdf.com';
        $persona1->direccion_fiscal ='RIO BIJAO, CHOLOMA, HONDURAS';
        $persona1->dias_pago ='30';
        $persona1->termino_pago_id =TerminosPago::all()->random()->id;
        $persona1->entidad_id =Entidad::all()->random()->id;
        $persona1->tipo_persona_id =TiposPersona::all()->random()->id;
        $persona1->exonerado =$faker->randomElement([1, 2]);
        $persona1->save();
        if($persona1->exonerado==2){
            // $this->$faker;
            $name = $faker->unique()->word(20);
            $year = $faker->numberBetween(2020, date('Y'));
            $fechaInicio = "{$year}-01-01";
            $fechaFin = "{$year}-12-31";
            $fechaAleatoria = $faker->dateTimeBetween($fechaInicio, $fechaFin);
            // $persona->exoneraciones()->attach($persona->id,[PersonaExoneracion::factory(1)->create()]);
            $persona1->exoneraciones()->create( ['persona_id'=>$persona1->id,
                'registro' => $name,
                'status' => $faker->randomElement([1, 2]),
                'fecha_vencimiento' =>$fechaAleatoria
            ]);
        }

        $persona2 =new Persona();
        $persona2->name ='ALONSO FORWARDING COSTA RICA S.A.';
        $persona2->rtn ='3101786554';
        $persona2->telefono ='999999';
        $persona2->email ='asf@gmail.com';
        $persona2->direccion_fiscal ='OFICENTRO EJECUTIVO LA SABANA TORRE 3 PISO 2 OFICINA 9, SAN JOSE, COSTA RICA';
        $persona2->dias_pago ='30';
        $persona2->termino_pago_id =TerminosPago::all()->random()->id;
        $persona2->entidad_id =Entidad::all()->random()->id;
        $persona2->tipo_persona_id =TiposPersona::all()->random()->id;
        $persona2->exonerado =$faker->randomElement([1, 2]);
        $persona2->save();
        if($persona2->exonerado==2){
            // $this->$faker;
            $name = $faker->unique()->word(20);
            $year = $faker->numberBetween(2020, date('Y'));
            $fechaInicio = "{$year}-01-01";
            $fechaFin = "{$year}-12-31";
            $fechaAleatoria = $faker->dateTimeBetween($fechaInicio, $fechaFin);
            // $persona->exoneraciones()->attach($persona->id,[PersonaExoneracion::factory(1)->create()]);
            $persona2->exoneraciones()->create( ['persona_id'=>$persona2->id,
                'registro' => $name,
                'status' => $faker->randomElement([1, 2]),
                'fecha_vencimiento' =>$fechaAleatoria
            ]);
        }

        $persona3 =new Persona();
        $persona3->name ='SUMINISTROS ELECTRICOS S. DE R.L. DE C.V.';
        $persona3->rtn ='05019995092273';
        $persona3->telefono ='3333333';
        $persona3->email ='asdf@asdf.com';
        $persona3->direccion_fiscal ='SPS';
        $persona3->dias_pago ='30';
        $persona3->termino_pago_id =TerminosPago::all()->random()->id;
        $persona3->entidad_id =Entidad::all()->random()->id;
        $persona3->tipo_persona_id =TiposPersona::all()->random()->id;
        $persona3->exonerado =$faker->randomElement([1, 2]);
        $persona3->save();
        if($persona3->exonerado==2){
            // $this->$faker;
            $name = $faker->unique()->word(20);
            $year = $faker->numberBetween(2020, date('Y'));
            $fechaInicio = "{$year}-01-01";
            $fechaFin = "{$year}-12-31";
            $fechaAleatoria = $faker->dateTimeBetween($fechaInicio, $fechaFin);
            // $persona->exoneraciones()->attach($persona->id,[PersonaExoneracion::factory(1)->create()]);
            $persona3->exoneraciones()->create( ['persona_id'=>$persona3->id,
                'registro' => $name,
                'status' => $faker->randomElement([1, 2]),
                'fecha_vencimiento' =>$fechaAleatoria
            ]);
        }
        $persona4 =new Persona();
        $persona4->name ='TRANSPORTES BELTRAN';
        $persona4->rtn ='18041960020777';
        $persona4->telefono ='8888888';
        $persona4->email ='asdf@asdf.com';
        $persona4->direccion_fiscal ='TGU';
        $persona4->dias_pago ='30';
        $persona4->termino_pago_id =TerminosPago::all()->random()->id;
        $persona4->entidad_id =Entidad::all()->random()->id;
        $persona4->tipo_persona_id =TiposPersona::all()->random()->id;
        $persona4->exonerado =$faker->randomElement([1, 2]);
        $persona4->save();
        if($persona4->exonerado==2){
            // $this->$faker;
            $name = $faker->unique()->word(20);
            $year = $faker->numberBetween(2020, date('Y'));
            $fechaInicio = "{$year}-01-01";
            $fechaFin = "{$year}-12-31";
            $fechaAleatoria = $faker->dateTimeBetween($fechaInicio, $fechaFin);
            // $persona->exoneraciones()->attach($persona->id,[PersonaExoneracion::factory(1)->create()]);
            $persona4->exoneraciones()->create( ['persona_id'=>$persona4->id,
                'registro' => $name,
                'status' => $faker->randomElement([1, 2]),
                'fecha_vencimiento' =>$fechaAleatoria
            ]);
        }
    }
}

/*
$fechaInicio = "{$year}-01-01";
$fechaFin = "{$year}-12-31";
$fechaAleatoria = $this->faker->dateTimeBetween($fechaInicio, $fechaFin);
return;*/