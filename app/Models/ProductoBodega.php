<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoBodega extends Model
{
    use HasFactory;

    protected $table = 'producto_bodegas';

    protected $fillable = [
        'nro_lote',
        'codigo_barra',
        'precio_compra',
        'precio_venta_base',
        'stock',
        'fecha_vencimiento',
        'producto_id',
    ];

    public function Producto(){
        return $this->belongsTo(Producto::class);
    }

    public function inventarios(){
        return $this->hasMany(Inventario::class);
    }

    public function detalle_salidas(){
        return $this->hasMany(DetalleSalida::class);
    }

    public function __toString()
    {
        return $this->codigo_barra . ', ' . $this->nro_lote . ', ' . $this->producto;
    }
}
