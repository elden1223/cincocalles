<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;

    protected $table = 'devoluciones';

    protected $fillable = [
        'fecha',
        'observaciones',
        'aprobado',  
        'detalle_venta_id', 
    ];

    public function DetalleVenta(){
        return $this->belongsTo(DetalleVenta::class);
    }

    public function __toString()
    {
        return $this->id . ' - ' . $this->fecha;
    }
}
