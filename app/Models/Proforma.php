<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    use HasFactory;

    public function moneda(){
        return $this->belongsTo(Moneda::class);
    }
    public function embarque(){
        return $this->belongsTo(Embarque::class,'embarque_id');
    }


    //Relacion muchos a muchos
    public function servicios(){
        return $this->belongsToMany(Servicio::class, 'proforma_servicio')
        ->withPivot('precio', 'cantidad','descripcion', 'total','isv','unidad_medida');
    }

    public function estados()
    {
        return $this->hasMany(ProformaEstado::class);
    }
    
     // Definimos un evento "saving" para generar el número_embarque antes de guardar el registro
     protected static function boot()
     {
         parent::boot();
 
         static::saving(function ($proforma) {
             $proforma->num_documento = static::generateUniqueNumber();
         });
     }
 
     // Método para generar el número_embarque para los embarques principales
     protected static function generateUniqueNumber()
     {
        $existingProforma=false;
        $lastNumber=0;
        $i=1;
        $newNumber = '1';
        // Si es un embarque principal, generamos el número normal
        $year = date('Y');
        $month = date('m');
        $month=str_pad($month, 2, '0', STR_PAD_LEFT);
        do {
            // static::whereYear('periodo_sys', $year)->count();
            if(!$existingProforma){    
                $lastProforma = static::where('num_documento', 'LIKE', "GSA{$year}-{$month}-%")
                ->get();
                if ($lastProforma) {
                    $lastNumber = (int)$lastProforma->count();
                }
            }
            $newNumber = str_pad($lastNumber + $i, 3, '0', STR_PAD_LEFT);
            $proposedNumber = "GSA{$year}-{$month}-{$newNumber}";
            // Verificamos si el número generado ya existe en la base de datos
            $existingProforma = static::where('num_documento', $proposedNumber)->first();
            $i++;                
        } while ($existingProforma);
        return $proposedNumber;
     }
}

