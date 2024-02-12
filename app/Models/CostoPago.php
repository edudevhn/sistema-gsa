<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostoPago extends Model
{
    protected $fillable=['total_pago','cuenta_bancaria_id','costo_id'];
    use HasFactory;
    
    public function cuentaBancaria(){
        return $this->belongsTo(CuentaBancaria::class);
    }


}
