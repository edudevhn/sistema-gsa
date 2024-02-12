<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costo extends Model
{
    use HasFactory;

    public function moneda(){
        return $this->belongsTo(Moneda::class);
    }
    //Relacion muchos a muchos
    
    public function embarque()
    {
        return $this->belongsToMany(Embarque::class, 'embarque_costo', 'costo_id', 'embarque_id');
    }

    public function servicio(){
        return $this->belongsTo(Servicio::class,'servicio_id');
    }
    public function proveedor(){
        return $this->belongsTo(Persona::class,'proveedor_id');
    }

    public function tipoCosto(){
        return $this->belongsTo(TipoCosto::class);
    }

    public function pagos(){
        return $this->hasMany(CostoPago::class);
    }


    public function estados()
    {
        return $this->hasMany(CostosEstado::class);
    }
   
}
