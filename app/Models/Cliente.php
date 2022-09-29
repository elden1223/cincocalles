<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nro_documento',
        'nombres',
        'apellidos',  
        'fecha_nacimiento',
        'email', 
        'telefono',    
    ];

    public function reclamos(){
        return $this->hasMany(Reclamo::class);
    }

    public function devoluciones(){
        return $this->hasMany(Devolucion::class);
    }

    public function ventas(){
        return $this->hasMany(Venta::class);
    }

    public function __toString()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }
}
