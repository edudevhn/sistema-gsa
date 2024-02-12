<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Aduana;
use App\Models\Category;
use App\Models\Consignatario;
use App\Models\Cotizacion;
use App\Models\Cuenta;
use App\Models\CuentaBancaria;
use App\Models\Destino;
use App\Models\DocumentosFiscalesTipo;
use App\Models\Embarque;
use App\Models\Factura;
use App\Models\Incoterm;
use App\Models\Mercancia;
use App\Models\Modalidad;
use App\Models\Moneda;
use App\Models\Parameter;
use App\Models\Persona;
use App\Models\Servicio;
use App\Models\Tag;
use App\Models\TerminosPago;
use App\Models\TiposPersona;
use App\Models\TiposServicio;
use App\Models\ValueType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $direcory='/public/posts';
        
        Storage::deleteDirectory($direcory);
        Storage::makeDirectory($direcory);


        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        //Aduana::factory(4)->create();
        Parameter::factory(7)->create();
        $this->call(MonedaSeeder::class);
        $this->call(ConfigSeeder::class);
        $this->call(CuentasSeeder::class);
        $this->call(ServiciosSeeder::class);
        // $this->call(ServiciosSeeder::class);
        $this->call(DocumentosFiscalesRangoSeeder::class);
        $this->call(PersonaSeeder::class);
        // ValueType::factory(2)->create();
       // Cuenta::factory(10)->create();
       // TiposPersona::factory(3)->create();
       // DocumentosFiscalesTipo::factory(2)->create();
       //$this->call(PersonaSeeder::class);
       //Persona::factory(25)->create();
        //CuentaBancaria::factory(3)->create();
        //Servicio::factory(25)->create();
        //Mercancia::factory(5)->create();
        //Incoterm::factory(5)->create();
       // TiposServicio::factory(5)->create();
        //Destino::factory(5)->create();
        //TerminosPago::factory(5)->create();
       // Modalidad::factory(5)->create();
        //Consignatario::factory(5)->create();
        Cotizacion::factory(30)->create();
        Embarque::factory(15)->create();
       // Factura::factory(30)->create();




        // Category::factory(4)->create();
        // Tag::factory(8)->create();
        // $this->call(PostSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
