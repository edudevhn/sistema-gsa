<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosFiscalesTipo extends Model
{
    use HasFactory;
    protected $fillable=['name'];

    protected function name():Attribute{
        return new Attribute(
            set: fn($value)=>strtoupper($value)
        );
    }
    //Relacion uno a muchos
    public function rangosDocumentos(){
        return $this->hasMany(DocumentosFiscalesRango::class);
    }


    public function documentosFiscales(){
        return $this->hasMany(DocumentosFiscales::class);
    }

    //Relacion uno a muchos inversa
    public function valueType(){
        return $this->belongsTo(ValueType::class);
    }

    public function costos(){
        return $this->belongsToMany(Costo::class, 'embarque_costo');
    }
}
