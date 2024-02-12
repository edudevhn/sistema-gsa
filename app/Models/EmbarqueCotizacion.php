<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmbarqueCotizacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'cotizacion_id',
        // otras columnas fillable que puedas tener
    ];
    
    protected $table="embarque_cotizacion";

    public function embarque()
    {
        return $this->belongsTo(Embarque::class);
    }

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
