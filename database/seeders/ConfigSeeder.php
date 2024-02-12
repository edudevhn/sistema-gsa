<?php

namespace Database\Seeders;

use App\Models\Aduana;
use App\Models\Banco;
use App\Models\Costo;
use App\Models\CuentaBancaria;
use App\Models\Destino;
use App\Models\DocumentosFiscalesTipo;
use App\Models\Entidad;
use App\Models\Frontera;
use App\Models\Incoterm;
use App\Models\Mercancia;
use App\Models\MetodoPago;
use App\Models\Modalidad;
use App\Models\TerminosPago;
use App\Models\TipoCosto;
use App\Models\TipoCuenta;
use App\Models\TiposPersona;
use App\Models\TiposServicio;
use App\Models\ValueType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ValueType::create(['name'=>'GRAVADO']);
        ValueType::create(['name'=>'EXENTO']);
        DocumentosFiscalesTipo::create(['name'=>'FACTURA','slug'=>'F','value_type_id'=>1]);
        DocumentosFiscalesTipo::create(['name'=>'NOTA DE DEBITO','slug'=>'NB','value_type_id'=>2]);
        Entidad::create(['name'=>'LOCAL']);
        Entidad::create(['name'=>'EXTRANJERO']);
        TiposPersona::create(['name'=>'CLIENTE']);
        TiposPersona::create(['name'=>'PROVEEDOR']);
        TiposPersona::create(['name'=>'AMBOS']);
        Banco::create(['name'=>'BAC HONDURAS']);
        Banco::create(['name'=>'FICOHSA']);
        TipoCuenta::create(['name'=>'AHORRO']);
        TipoCuenta::create(['name'=>'CHEQUES']);
        Frontera::create(['name'=>'CHINA']);
        Frontera::create(['name'=>'USA']);
        Frontera::create(['name'=>'ESPAÑA']);
        Frontera::create(['name'=>'JAPON']);
        Frontera::create(['name'=>'JAPON']);
        CuentaBancaria::create(['name'=>'CUENTA No. 1 - LEMPIRAS','beneficiario'=>'SINDY JOHANNA FONSECA HERNÁNDEZ / GRUPO SERVICIOS ADUANEROS (GSA)','rtn'=>'08011991010995','num_cuenta'=>'730410301','banco_id'=>1,'moneda_id'=>1,'tipo_cuenta_id'=>1]);
        CuentaBancaria::create(['name'=>'CUENTA No. 2 - LEMPIRAS','beneficiario'=>'SINDY JOHANNA FONSECA HERNÁNDEZ / GRUPO SERVICIOS ADUANEROS (GSA)','rtn'=>'08011991010995','num_cuenta'=>'200010733177','banco_id'=>2,'moneda_id'=>1,'tipo_cuenta_id'=>2]);
        CuentaBancaria::create(['name'=>'CUENTA No. 3 -  DÓLARES','beneficiario'=>'SINDY JOHANNA FONSECA HERNÁNDEZ / GRUPO SERVICIOS ADUANEROS (GSA)','rtn'=>'08011991010995','num_cuenta'=>'744797221','banco_id'=>1,'moneda_id'=>2,'tipo_cuenta_id'=>1]);
        TipoCosto::create(['name'=>'Costos de Embarque']);
        TipoCosto::create(['name'=>'Costos Administrativos']);
        Destino::create(['name'=>'CD. HIDALGO, MEXICO']);
        Destino::create(['name'=>'SAN PEDRO SULA, HONDURAS']);
        Destino::create(['name'=>'SAN JOSE, COSTA RICA']);
        Destino::create(['name'=>'SHANGHAI, CN']);
        Destino::create(['name'=>'PUERTO CORTES, HN']);
        Aduana::create(['name'=>'AGUA CALIENTE']);
        Aduana::create(['name'=>'LA MESA (SAP)']);
        Aduana::create(['name'=>'PUERTO CORTES']);
        Mercancia::create(['name'=>'CARGA GENERAL']);
        Incoterm::create(['name'=>'FCA']);
        TiposServicio::create(['name'=>'CFS-CFS']);
        TerminosPago::create(['name'=>'CREDITO']);
        TerminosPago::create(['name'=>'CONTADO']);
        Modalidad::create(['name'=>'AIR / COURIER']);
        Modalidad::create(['name'=>'TERRESTRE']);
        MetodoPago::create(['name'=>'CHEQUE']);
        MetodoPago::create(['name'=>'DEPOSITO']);
        MetodoPago::create(['name'=>'EFECTIVO']);
        MetodoPago::create(['name'=>'TRANSFERENCIA BANCARIA']);
    }
}
