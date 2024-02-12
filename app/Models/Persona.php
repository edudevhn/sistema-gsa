<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillable=['name','rtn','telefono','email','direccion_fiscal','exonerado','tipo_persona_id','entidad_id'];

    protected function name():Attribute{
        return new Attribute(
            set: fn($value)=>strtoupper($value)
        );
    }
    //Relacion uno a muchos inversa
    public function tipoPersona(){
        return $this->belongsTo(TiposPersona::class);
    }
    public function entidad(){
        return $this->belongsTo(Entidad::class);
    }
    public function terminoPago(){
        return $this->belongsTo(TerminosPago::class);
    }
     //Relacion uno a muchos
     public function cotizacion(){
        return $this->hasMany(Cotizacion::class);
    }

    public function embarques(){
        return $this->hasMany(Embarque::class);
    }

    public function exoneraciones(){
        return $this->hasMany(PersonaExoneracion::class);
    }

    public function pagos(){
        return $this->hasMany(Pago::class);
    }

    public function costo(){
        return $this->hasMany(Costo::class);
    }
    

}