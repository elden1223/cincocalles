<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Role;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter');
        $users = User::join('roles as r', 'users.rol_id', '=', 'r.id')
            ->where('users.email', 'LIKE', $filter . '%')
            ->orWhere('r.nombre', 'LIKE', $filter . '%')
            ->paginate(10);
        return view('admin.user.index', compact('users', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $empleados = Empleado::all();
        $sucursals = Sucursal::all();
        $roles = Role::all();
        return view('admin.user.create', compact('user', 'empleados', 'sucursals', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required',
            'empleado_id' => 'required',
            'sucursal_id' => 'required',
            'rol_id' => 'required',
        ]);

        $user = $request->all();
        $user['super_admin'] = true; //Modificar en futuro
        $user['password'] = Hash::make($request->get('password'));
        try {
            User::create($user);
            return redirect()->route('users')->with('success', 'Usuario creado correctamente');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        if ($user == null) {
            return redirect()->route('users');
        }

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        if ($user == null) {
            return redirect()->route('users');
        }

        $empleados = Empleado::all();
        $sucursals = Sucursal::all();
        $roles = Role::all();

        return view('admin.user.edit', compact('user', 'empleados', 'sucursals', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
            'empleado_id' => 'required',
            'sucursal_id' => 'required',
            'rol_id' => 'required',
        ]);

        try {
            $user = User::findOrFail($id);

            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->empleado_id = $request->get('empleado_id');
            $user->sucursal_id = $request->get('sucursal_id');
            $user->rol_id = $request->get('rol_id');
            $user->update();

            return redirect()->route('users')->with('success', 'Usuario actualizado correctamente');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();
            return redirect()->route('users')->with('success', 'Usuario eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('users')->with('error', $th->getMessage());
        }
    }
}
