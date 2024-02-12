<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    use HasFactory;
    protected $fillable=['name','tasa_cambio'];

    protected function name():Attribute{
        return new Attribute(
            set: fn($value)=>strtoupper($value)
        );
    }

    //Relacion uno a muchos
    public function servicios(){
        return $this->hasMany(Servicio::class);
    }

    

    //Relacion uno a muchos
    public function cotizaciones(){
        return $this->hasMany(Cotizacion::class);
    }

    //Relacion uno a muchos
    public function embarques(){
        return $this->hasMany(Embarque::class);
    }

    public function facturas(){
        return $this->hasMany(Factura::class);
    }

    public function cuentasBancarias(){
        return $this->hasMany(CuentaBancaria::class);
    }
    public function pagos(){
        return $this->hasMany(Pago::class);
    }

    public function costos(){
        return $this->hasMany(Costo::class);
    }
}
