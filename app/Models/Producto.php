<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'unidad_medida',
        'categoria_id',
    ];

    public function Categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function producto_bodegas(){
        return $this->hasMany(ProductoBodega::class);
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
