<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosFiscales extends Model
{
    use HasFactory;
    protected $guarded=['id','created_at','updated_at'];
    //Relacion uno a muchos inversa
    public function documentoTipo(){
        return $this->belongsTo(DocumentosFiscalesTipo::class);
    }
    // Define la relación muchos a uno con DocumentosFiscalesRangos
    public function rangoDocumento() {
        return $this->belongsTo(DocumentosFiscalesRango::class, 'documentos_fiscales_rango_id');
    }

    public function documentoFiscalDetalles() {
        return $this->belongsTo(DocumentosFiscalesDetalle::class, 'documento_fiscal_detalle_id');
    }

    public function embarque(){
        return $this->belongsTo(Embarque::class,'embarque_id');
    }

    public function servicios(){
        return $this->belongsToMany(Servicio::class, 'documentos_fiscales_servicios','documento_fiscal_id')->withPivot('precio', 'cantidad','descripcion', 'total','unidad_medida','isv');
    }
    public function pagos(){
        return $this->hasMany(Pago::class,'documento_fiscal_id');
    }
    public function estados()
    {
        return $this->hasMany(DocumentosFiscalesEstado::class,'documento_fiscal_id');
    }
}
