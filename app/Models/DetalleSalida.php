<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSalida extends Model
{
    use HasFactory;

    protected $table = 'detalle_salidas';

    protected $fillable = [
        'salida_producto_id',
        'producto_bodega_id',
        'cantidad',
    ];

    public function SalidaProducto(){
        return $this->belongsTo(SalidaProducto::class);
    }

    public function ProductoBodega(){
        return $this->belongsTo(ProductoBodega::class);
    }

    public function __toString()
    {
        return $this->productobodega;
    }
}
