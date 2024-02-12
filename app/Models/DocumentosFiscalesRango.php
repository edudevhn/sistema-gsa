<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosFiscalesRango extends Model
{
    use HasFactory;
    protected $table="documentos_fiscales_rangos";
    protected $guarded=['id','created_at','updated_at'];

    // public function facturas(){
    //     return $this->belongsToMany(Factura::class);
    // }
    // Define la relación uno a muchos inversa con DocumentoFiscal
    public function documentosFiscales() {
        return $this->hasMany(DocumentosFiscales::class);
    }
    //Relacion uno a muchos inversa
    public function documentoTipo(){
        return $this->belongsTo(DocumentosFiscalesTipo::class);
    }
}
