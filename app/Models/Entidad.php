<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;
    protected $table="entidades";
    protected $guarded=['id','created_at','updated_at'];

    //Relacion uno a muchos
    public function persona(){
        return $this->hasMany(Persona::class);
    }
}
