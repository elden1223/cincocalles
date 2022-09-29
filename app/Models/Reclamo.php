<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamo extends Model
{
    use HasFactory;

    protected $table = 'reclamos';

    protected $fillable = [
        'nro_venta',
        'descripcion',
        'fecha',  
        'estado',
        'cliente_id',   
    ];

    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function __toString()
    {
        return $this->nro_venta . ', ' . $this->fecha;
    }
}
