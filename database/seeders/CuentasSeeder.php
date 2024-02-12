<?php

namespace Database\Seeders;

use App\Models\Cuenta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CuentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cuenta::create(['name'=>'Ingreso por Flete / Gasto por Flete','descripcion'=>'']);
        Cuenta::create(['name'=>'Ingreso / Gasto','descripcion'=>'']);
    }   
}
























































