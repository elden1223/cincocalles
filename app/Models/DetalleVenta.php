<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_ventas';

    protected $fillable = [
        'venta_id',
        'inventario_id',
        'cantidad',
        'precio',
        'descuento',
    ];

    public function Venta(){
        return $this->belongsTo(Venta::class);
    }

    public function Inventario(){
        return $this->belongsTo(Inventario::class);
    }

    public function devoluciones(){
        return $this->hasMany(Devolucion::class);
    }

    public function __toString()
    {
        return $this->inventario . ', ' . $this->venta;
    }
}
