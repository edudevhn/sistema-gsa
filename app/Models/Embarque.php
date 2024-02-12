<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embarque extends Model
{
    use HasFactory;
    protected $guarded=['id','created_at','updated_at'];

    protected $casts = [
        'num_referencia' => 'string',
    ];


    protected function numReferencia():Attribute{
        return new Attribute(
            set: fn($value)=>strtoupper($value)
        );
    }
    //Relacion uno a muchos inversa
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
    public function consignatario(){
        return $this->belongsTo(Consignatario::class);
    }
    // public function pol(){
    //     return $this->belongsTo(Frontera::class,'pol_id');
    // }
    // public function pod(){
    //     return $this->belongsTo(Frontera::class,'pod_id');
    // }
    public function estados()
    {
        return $this->hasMany(EmbarqueEstado::class);
    }
    public function proformas(){
        return $this->hasMany(Proforma::class,'embarque_id');
    }
    
    public function documentosFiscales(){
        return $this->hasMany(DocumentosFiscales::class,'embarque_id');
    }


   
    public function costos()
    {
        return $this->belongsToMany(Costo::class, 'embarque_costo', 'embarque_id', 'costo_id');
    }
    //relacion muchos a muchos
    public function embarqueCotizacion()
    {
        return $this->hasOne(EmbarqueCotizacion::class);
    }

    // Relación con el embarque principal (opcional)
    public function embarquePrincipal()
    {
        return $this->belongsTo(Embarque::class, 'embarque_principal_id');
    }

    // Relación con los subembarques asociados
    public function subembarques()
    {
        return $this->hasMany(Embarque::class, 'embarque_principal_id');
    }
     //Relacion uno a muchos inversa
    public function moneda(){
        return $this->belongsTo(Moneda::class);
    }


     // Definimos un evento "saving" para generar el número_embarque antes de guardar el registro
     protected static function boot()
     {
         parent::boot();
 
         static::saving(function ($embarque) {
             if (!$embarque->embarque_principal_id) {
                 // Si es un embarque principal, se genera el número_embarque con el formato adecuado
                 $embarque->num_embarque = static::generateUniqueNumber($embarque->embarque_principal_id);
             } else {
                 // Si es un subembarque, se obtiene el número del embarque principal y se agrega la siguiente letra
                 $embarquePrincipal = static::find($embarque->embarque_principal_id);
                 $letter = static::getNextLetter($embarquePrincipal->subembarques->count());
                 $embarque->num_embarque = $embarquePrincipal->num_embarque . '-' . $letter;
             }
         });
     }
 
     // Método para generar el número_embarque para los embarques principales
     protected static function generateUniqueNumber($embarque_principal_id = null)
     {
        $existingEmbarque=false;
        $lastNumber=0;
        $i=1;
        $newNumber = '1';
        // Si es un embarque principal, generamos el número normal
        $year = date('Y');
        $month = date('m');
        $month=str_pad($month, 2, '0', STR_PAD_LEFT);
        do {
            if (!$embarque_principal_id) {
                if(!$existingEmbarque){    
                    $lastEmbarque = static::where('num_embarque', 'LIKE', "GSA{$year}-{$month}-%")
                    ->get();
                    if ($lastEmbarque) {
                        $lastNumber = (int)$lastEmbarque->count();
                    }
                }
                $newNumber = str_pad($lastNumber + $i, 3, '0', STR_PAD_LEFT);
                $proposedNumber = "GSA{$year}-{$month}-{$newNumber}";
            } else {
                // Si es un subembarque, obtenemos el número del embarque principal y le agregamos la siguiente letra
                $embarquePrincipal = static::find($embarque_principal_id);
                $letter = static::getNextLetter($embarquePrincipal->subembarques->count());
                $proposedNumber = $embarquePrincipal->num_embarque . '-' . $letter;
            }
    
            // Verificamos si el número generado ya existe en la base de datos
            $existingEmbarque = static::where('num_embarque', $proposedNumber)->first();        
            $i++;                
        } while ($existingEmbarque);
        return $proposedNumber;
     }
 
     // Método para obtener la siguiente letra del abecedario en mayúscula (A, B, C, ..., Z, AA, AB, ...)
     protected static function getNextLetter($count)
     {
         $letters = range('A', 'Z');
         if ($count < count($letters)) {
             return $letters[$count];
         } else {
             $firstLetterIndex = floor($count / count($letters)) - 1;
             $secondLetterIndex = $count % count($letters);
             return $letters[$firstLetterIndex] . $letters[$secondLetterIndex];
         }
     }
}


