<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventarios';

    protected $fillable = [
        'sucursal_id',
        'producto_bodega_id',
        'stock',
        'precio_venta',
    ];

    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

    public function ProductoBodega(){
        return $this->belongsTo(ProductoBodega::class);
    }

    public function inventario_ofertas(){
        return $this->hasMany(InventarioOferta::class);
    }

    public function __toString()
    {
        return $this->productobodega . '';
    }
}
