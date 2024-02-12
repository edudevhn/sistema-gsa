<?php

namespace Database\Seeders;

use App\Models\Moneda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1= Moneda::create(['name'=>'HNL','tasa_cambio'=>24.6617]);
        $role2= Moneda::create(['name'=>'USD','tasa_cambio'=>24.6617]);

    }
}
