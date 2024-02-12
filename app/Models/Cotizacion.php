<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $table="cotizaciones";
    protected $guarded=['id','created_at','updated_at'];
    //protected $fillable=['tc_usd','tc_hnd'];
    

     //Relacion uno a muchos inversa
    public function moneda(){
        return $this->belongsTo(Moneda::class);
    }
    public function persona(){
        return $this->belongsTo(Persona::class);
    }
    public function mercancia(){
        return $this->belongsTo(Mercancia::class);
    }
    public function incoterms(){
        return $this->belongsTo(Incoterm::class);
    }
    public function tipoServicio(){
        return $this->belongsTo(TiposServicio::class);
    }
    public function aduana(){
        return $this->belongsTo(Aduana::class);
    }
    public function lugarEmbarque(){
        return $this->belongsTo(Destino::class);
    }
    public function lugarEntrega(){
        return $this->belongsTo(Destino::class);
    }
    public function terminoPago(){
        return $this->belongsTo(TerminosPago::class);
    }
    public function modalidad(){
        return $this->belongsTo(Modalidad::class);
    }
     //Relacion muchos a muchos
     public function servicios(){
        return $this->belongsToMany(Servicio::class, 'cotizacion_servicio')->withPivot('precio', 'cantidad','descripcion', 'isv', 'total','unidad_medida');
    }

    public function estados()
    {
        return $this->hasMany(CotizacionEstado::class);
    }
    public function embarqueCotizacion()
    {
        return $this->hasOne(EmbarqueCotizacion::class);
    }

    
     // Definimos un evento "saving" para generar el número_embarque antes de guardar el registro
     protected static function boot()
     {
         parent::boot();
         static::saving(function ($cotizacion) {
            if (!$cotizacion->exists || $cotizacion->isDirty('num_documento')) {
                 $cotizacion->num_documento = static::generateUniqueNumber();
            }
         });
     }
 
     // Método para generar el número_embarque para los embarques principales
     protected static function generateUniqueNumber()
     {
        $existingCotizacion=false;
        $lastNumber=0;
        $i=1;
        $newNumber = '1';
        // Si es un embarque principal, generamos el número normal
        $year = date('Y');
        $year=substr($year, -2);
        do {
            // static::existingCotizacion('periodo_sys', $year)->count();
            if(!$existingCotizacion){    
                $lastCotizacion = static::where('num_documento', 'LIKE', "GSA{$year}-%")
                ->get();
                if ($lastCotizacion) {
                    $lastNumber = (int)$lastCotizacion->count();
                }
            }
            $newNumber = str_pad($lastNumber + $i, 3, '0', STR_PAD_LEFT);
            $proposedNumber = "GSA{$year}-{$newNumber}";
            // Verificamos si el número generado ya existe en la base de datos
            $existingCotizacion = static::where('num_documento', $proposedNumber)->first();
            $i++;  
        } while ($existingCotizacion);
        return $proposedNumber;
     }

}

