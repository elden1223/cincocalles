<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSucursal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',     
    ];

    public function sucursals(){
        return $this->hasMany(User::class);
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
