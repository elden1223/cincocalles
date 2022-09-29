<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioOferta extends Model
{
    use HasFactory;

    protected $table = 'inventario_ofertas';

    protected $fillable = [
        'inventario_id',
        'oferta_id',
    ];

    public function Inventario(){
        return $this->belongsTo(Inventario::class);
    }

    public function Oferta(){
        return $this->belongsTo(Oferta::class);
    }

    public function __toString()
    {
        return $this->oferta;
    }
}
