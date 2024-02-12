<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaBancaria extends Model
{
    protected $guarded=['id','created_at','updated_at'];

    use HasFactory;
    public function moneda(){
        return $this->belongsTo(Moneda::class);
    }
    public function banco(){
        return $this->belongsTo(Banco::class);
    }

    public function tipoCuenta(){
        return $this->belongsTo(TipoCuenta::class);
    }

    public function costoPagos(){
        return $this->hasMany(CostoPago::class);
    }
    
    public function pagos(){
        return $this->hasMany(Pago::class);
    }
}