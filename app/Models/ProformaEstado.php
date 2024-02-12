<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProformaEstado extends Model
{
    use HasFactory;
    protected $fillable = ['proforma_id', 'estado','observacion', 'user_id'];

    protected function estado():Attribute{
        return new Attribute(
            set: fn($value)=>strtoupper($value)
        );
    }
    public function proforma()
    {
        return $this->belongsTo(Proforma::class);
    }
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
