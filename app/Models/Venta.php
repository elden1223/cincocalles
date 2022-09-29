<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
        'nro_venta',
        'cliente_id',
        'tipo_pago_id',
        'user_id',
        'fecha',
        'total',
    ];

    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function TipoPago(){
        return $this->belongsTo(TipoPago::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function __toString()
    {
        return $this->descripcion;
    }
}
