<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incoterm extends Model
{
    use HasFactory;
    protected $fillable=['name','status'];

    protected function name():Attribute{
        return new Attribute(
            set: fn($value)=>strtoupper($value)
        );
    }

    public function cotizacion(){
        return $this->hasMany(Cotizacion::class);
    }
    public function embarque(){
        return $this->hasMany(Embarque::class);
    }
}
