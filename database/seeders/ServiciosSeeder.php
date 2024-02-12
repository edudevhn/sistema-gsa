<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Servicio::create(['name'=>'Servicio - Flete Internacional','name_interno'=>'Costo - Flete Internacional','descripcion'=>'Para todo costo/venta referente a flete internacional de importación y exportación.','cuenta_id'=>1,'status'=>2,'value_type_id'=>2]);
        Servicio::create(['name'=>'Gastos en Destino / Pagos a Terceros','name_interno'=>'Costo - Pagos a Terceros en Destino','descripcion'=>'Para todo costo/venta referente a Gastos en Destino que no son gravados.','cuenta_id'=>1,'status'=>2,'value_type_id'=>2]);
        Servicio::create(['name'=>'Gastos en Origen / Pagos a Terceros','name_interno'=>'Costo - Pagos a Terceros en Origen','descripcion'=>'Para todo costo/venta referente a Gastos de Origen que no son gravados.','cuenta_id'=>1,'status'=>2,'value_type_id'=>2]);
        Servicio::create(['name'=>'Otros Gastos de Aduana / Pagos a Terceros','name_interno'=>'Costo - Gastos de Aduana','descripcion'=>'Para todo costo/venta referente a Gastos generados en procesos aduaneros - No Gravable.','cuenta_id'=>2,'status'=>2,'value_type_id'=>2]);
        Servicio::create(['name'=>'Impuestos de Importación / Gastos Aduana','name_interno'=>'Costo - Impuestos de Importación','descripcion'=>'Impuestos de Importación pagados a la Aduana','cuenta_id'=>2,'status'=>2,'value_type_id'=>2]);
        Servicio::create(['name'=>'Seguro de Mercancías ','name_interno'=>'Costo - Seguro de Mercancías','descripcion'=>'Para todo costo/venta referente a Seguro','cuenta_id'=>2,'status'=>2,'value_type_id'=>2]);
        Servicio::create(['name'=>'Demoras por Contenedor / Pagos a Terceros','name_interno'=>'Costo - (P.A.T.) Demoras','descripcion'=>'Aplica para las demoras de Contenedor/Equipo','cuenta_id'=>2,'status'=>2,'value_type_id'=>2]);
        Servicio::create(['name'=>'Costo Bancario / Bank fee','name_interno'=>'Costo - Bank Fee','descripcion'=>'Costos Financieros','cuenta_id'=>2,'status'=>2,'value_type_id'=>2]);
        Servicio::create(['name'=>'Collect Fee','name_interno'=>'Costo - Collect Fee','descripcion'=>'Costos Financieros','cuenta_id'=>2,'status'=>2,'value_type_id'=>2]);
        Servicio::create(['name'=>'Otros Gastos Operativos','name_interno'=>'Costo - Otros Gastos','descripcion'=>'Servicios Aduaneros y otros que corresponda','cuenta_id'=>2,'status'=>2,'value_type_id'=>2]);
        Servicio::create(['name'=>'Servicio de Flete Local','name_interno'=>'Costo - Flete Local','descripcion'=>'Para toda entrega o recolecta en Territornio Nacional.','cuenta_id'=>1,'status'=>2,'value_type_id'=>1]);
        Servicio::create(['name'=>'Acarreo de Equipo / Inland Drayage','name_interno'=>'Costo - Acarreo de Equipo','descripcion'=>'Para movimientos de Equipos FCL/ Entrega dentro de Territorio Hondureño','cuenta_id'=>2,'status'=>2,'value_type_id'=>1]);
        Servicio::create(['name'=>'Documentación / Documentation Fee','name_interno'=>'Costo - Documentación','descripcion'=>'Para toda venta referente a documentación','cuenta_id'=>2,'status'=>2,'value_type_id'=>1]);
        Servicio::create(['name'=>'Otros Gastos / Flete Local','name_interno'=>'Costo - Otros Gastos Flete Local','descripcion'=>'Aplica por concepto de Sobreestadías para Camion y Chasis - FCL','cuenta_id'=>2,'status'=>2,'value_type_id'=>1]);
        Servicio::create(['name'=>'Servicios Aduaneros','name_interno'=>'Costo - Servicios Aduaneros','descripcion'=>'Servicio Aduanero Import / Export de cualquier Régimen','cuenta_id'=>2,'status'=>2,'value_type_id'=>1]);
        Servicio::create(['name'=>'Desconsolidación / Deconsolidation Fee (DDF)','name_interno'=>'N/A','descripcion'=>'Aplica para GSA LOGISTICA','cuenta_id'=>2,'status'=>2,'value_type_id'=>1]);
        Servicio::create(['name'=>'Manejo / Gasto Administrativo','name_interno'=>'Costo - Handling/Manejo','descripcion'=>'Para toda operación que aplique','cuenta_id'=>2,'status'=>2,'value_type_id'=>1]);
  
    }
}
