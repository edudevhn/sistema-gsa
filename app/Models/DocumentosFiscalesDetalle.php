<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosFiscalesDetalle extends Model
{
    use HasFactory;
    protected $guarded=['id','created_at','updated_at'];
    //protected $fillable=['tc_usd','tc_hnd'];
    //Relacion uno a muchos inversa


    public function moneda(){
        return $this->belongsTo(Moneda::class);
    }

    public function documentoFiscal() {
        return $this->hasMany(DocumentosFiscales::class, 'datos_comunes_id');
    }
}
