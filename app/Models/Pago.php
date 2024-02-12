<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table="pagos";

    protected $guarded=['id','created_at','updated_at'];
    
   
  /*  public function factura(){
        return $this->belongsTo(Pago::class,'factura_id');
    }
*/
    public function persona(){
        return $this->belongsTo(Persona::class);
    }
    public function banco(){
        return $this->belongsTo(Banco::class);
    }
    public function moneda(){
        return $this->belongsTo(Moneda::class);
    }
    public function documentoFiscal(){
        return $this->belongsTo(DocumentosFiscales::class,'documento_fiscal_id');
    }
    public function cuentaBancaria(){
        return $this->belongsTo(CuentaBancaria::class);
    }
    public function metodoPago(){
        return $this->belongsTo(MetodoPago::class);
    }
     // Definimos un evento "saving" para generar el número_embarque antes de guardar el registro
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($pago) {
            $pago->num_documento = static::generateUniqueNumber();
        });
    }
    // Método para generar el número_embarque para los embarques principales
    protected static function generateUniqueNumber()
    {
        $existingRecibo=false;
        $lastNumber=0;
        $i=1;
        $newNumber = '1';
        $year = date('Y');
        $month = date('m');
        $month=str_pad($month, 2, '0', STR_PAD_LEFT);
        do {
            // static::whereYear('periodo_sys', $year)->count();
            if(!$existingRecibo){    
                $lastRecbio = static::where('num_documento', 'LIKE', "GSA{$year}{$month}%")
                ->get();
                if ($lastRecbio) {
                    $lastNumber = (int)$lastRecbio->count();
                }
            }
            $newNumber = str_pad($lastNumber + $i, 3, '0', STR_PAD_LEFT);
            $proposedNumber = "GSA{$year}{$month}{$newNumber}";
            // Verificamos si el número generado ya existe en la base de datos
            $existingRecibo = static::where('num_documento', $proposedNumber)->first();
            $i++;                
        } while ($existingRecibo);
        return $proposedNumber;
    }

}
