<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueType extends Model
{
    use HasFactory;

    protected $fillable=['name'];

    protected function name():Attribute{
        return new Attribute(
            set: fn($value)=>strtoupper($value)
        );
    }

    
    //Relacion uno a muchos
    public function servicio(){
        return $this->hasMany(Servicio::class);
    }

    public function documentoTipo(){
        return $this->hasOne(DocumentosFiscalesTipo::class);
    }

}
