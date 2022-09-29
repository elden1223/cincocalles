<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
        'direccion',
        'telefono',
        'descripcion',  
        'url_logo',
        'tipo_sucursal_id',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function TipoSucursal(){
        return $this->belongsTo(TipoSucursal::class);
    }

    public function inventarios(){
        return $this->hasMany(Inventario::class);
    }

    public function salida_productos(){
        return $this->hasMany(SalidaProducto::class);
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
