<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $fillable=['name','status'];

    protected function name():Attribute{
        return new Attribute(
            set: fn($value)=>strtoupper($value)
        );
    }

    public function cuentasBancarias(){
        return $this->hasMany(CuentaBancaria::class);
    }


    public function pagos(){
        return $this->hasMany(Pago::class);
    }
}
