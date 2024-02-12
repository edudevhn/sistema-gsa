<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable=['name','descripcion','status','cuenta_id'];

    protected function name():Attribute{
        return new Attribute(
            set: fn($value)=>strtoupper($value)
        );
    }
    //Relacion uno a muchos inversa
    public function cuenta(){
        return $this->belongsTo(Cuenta::class);
    }
    
    public function valueType(){
        return $this->belongsTo(ValueType::class);
    }
    //relacion muchos am uchos
    public function cotizaciones(){
        // return $this->belongsToMany(Cotizacion::class);
        return $this->belongsToMany(Cotizacion::class, 'cotizacion_servicio')
        ->withPivot('precio', 'cantidad','descripcion', 'isv', 'total','unidad_medida');
    }

    // public function facturas(){
    //     return $this->belongsToMany(Factura::class, 'factura_servicio')
    //     ->withPivot('precio', 'cantidad','descripcion', 'isv', 'total','unidad_medida');
    // }

    public function documentosFiscales(){
        return $this->belongsToMany(DocumentosFiscales::class, 'factura_servicio')
        ->withPivot('precio', 'cantidad','descripcion', 'isv', 'total','unidad_medida');
    }
    public function proformas(){
        return $this->belongsToMany(Proforma::class, 'proforma_servicio')
        ->withPivot('precio', 'cantidad','descripcion', 'isv', 'total','unidad_medida');
    }


    public function costo(){
        return $this->hasMany(Costo::class);
    }

    
}