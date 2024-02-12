<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposPersona extends Model
{
    use HasFactory;
    protected $fillable=['name'];

    protected function name():Attribute{
        return new Attribute(
            set: fn($value)=>strtoupper($value)
        );
    }

    //Relacion uno a muchos
    public function persona(){
        return $this->hasMany(Persona::class);
    }
}
