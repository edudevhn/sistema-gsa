<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $guarded=['id','created_at','updated_at'];
    //protected $fillable=['tc_usd','tc_hnd'];
    //Relacion uno a muchos inversa


    public function moneda(){
        return $this->belongsTo(Moneda::class);
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
    public function pol(){
        return $this->belongsTo(Aduana::class,'pol_id');
    }
    public function pod(){
        return $this->belongsTo(Aduana::class,'pod_id');
    }

    public function proformas(){
        return $this->hasMany(Proforma::class,'embarque_id');
    }
    //Relacion muchos a muchos
    public function servicios(){
        return $this->belongsToMany(Servicio::class, 'factura_servicio')->withPivot('precio', 'cantidad','descripcion', 'total','unidad_medida','isv');
    }

    public function documentosRangos(){
        return $this->belongsToMany(DocumentosFiscalesRango::class,'factura_documento_rango')->withPivot('id','numero_documento','sub_total','isv','total');
    }
    
    public function embarque(){
        return $this->belongsTo(Embarque::class,'embarque_id');
    }

    public function pagos(){
        return $this->hasMany(Pago::class,'factura_id');
    }
}
