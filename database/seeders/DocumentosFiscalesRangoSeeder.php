<?php

namespace Database\Seeders;

use App\Models\DocumentosFiscalesRango;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentosFiscalesRangoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DocumentosFiscalesRango::create(['numero_inicial'=>'000-002-01-00000201',
        'numero_final'=>'000-002-01-00000700',
        'cantidad_otorgada'=>500,
        'cantidad_emitidas'=>0,
        'fecha_limite_emision'=>'2023-08-02',
        'numero_cai'=>'115629-F5969F-6D4AB8-3C1AC7-CDA840-05',
        'status'=>2,
        'documento_tipo_id'=>'1']);
        DocumentosFiscalesRango::create(['numero_inicial'=>'000-002-07-00000801',
        'numero_final'=>'000-002-01-00000900',
        'cantidad_otorgada'=>100,
        'cantidad_emitidas'=>0,
        'fecha_limite_emision'=>'2023-08-02',
        'numero_cai'=>'6DA691-E788B7-A345A1-FEF48E-B79392-C9',
        'documento_tipo_id'=>'2','status'=>2]);
    }
}
