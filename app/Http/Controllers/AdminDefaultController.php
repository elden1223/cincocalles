<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Empleado;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDefaultController extends Controller
{
    public function default(){
        $users = User::all();
        if(count($users) == 0){
            Role::create(['nombre' => 'Administrador']);
            Empleado::create([
                'nro_documento' => '',
                'nombres' => '',
                'apellidos' => '',
                'fecha_nacimiento' => '2000-12-12',
                'email' => 'admin@gmail.com',
                'telefono' => '',
            ]);

            return User::create([
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'super_admin' => true,
                'empleado_id' => 1,
                'rol_id' => 1,
            ]);
        }
        return redirect()->route('login');
    }
}