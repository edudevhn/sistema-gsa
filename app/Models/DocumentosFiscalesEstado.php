<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosFiscalesEstado extends Model
{
    use HasFactory;
    protected $fillable = ['cotizacion_id','observacion', 'estado', 'user_id'];

    protected function estado():Attribute{
        return new Attribute(
            set: fn($value)=>strtoupper($value)
        );
    }
    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
