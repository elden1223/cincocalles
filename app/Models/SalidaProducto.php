<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalidaProducto extends Model
{
    use HasFactory;

    protected $table = 'salida_productos';

    protected $fillable = [
        'nro_salida',
        'fecha',
        'observaciones',
        'personal_cargo',
        'procesado',
        'sucursal_id',
    ];

    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

    public function detalle_salidas(){
        return $this->hasMany(DetalleSalida::class);
    }

    public function __toString()
    {
        return $this->nro_salida;
    }
}
