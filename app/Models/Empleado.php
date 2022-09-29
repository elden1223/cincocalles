<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nro_documento',
        'nombres',
        'apellidos',  
        'fecha_nacimiento',
        'email', 
        'telefono'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function __toString()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }
}
