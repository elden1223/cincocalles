<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    protected $table = 'ofertas';

    protected $fillable = [
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'porc_descuento',
    ];

    public function inventario_ofertas(){
        return $this->hasMany(InventarioOferta::class);
    }

    public function __toString()
    {
        return $this->descripcion . ', [ ' . $this->fecha_inicio . ' - ' . $this->fecha_fin . ' ]';
    }
}
