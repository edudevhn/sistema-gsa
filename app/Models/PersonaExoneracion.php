<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaExoneracion extends Model
{
    use HasFactory;
    protected $table="persona_exoneracion";
    protected $guarded=['id','created_at','updated_at'];
/*
    public function persona(){
        return $this->belongsTo(Persona::class);
    }*/

}

