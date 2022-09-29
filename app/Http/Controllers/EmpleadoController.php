<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $empleados = Empleado::where('nro_documento', 'LIKE', $filter . '%')->paginate(10);
        return view('admin.empleado.index', compact('empleados', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleado = new Empleado();
        return view('admin.empleado.create', compact('empleado'));
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
            'nro_documento' => 'required:unique:empleados',
            'nombres' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required|date',
            'email' => 'required|unique:empleados',
        ]);

        $empleado = $request->all();
        try {
            Empleado::create($empleado);
            return redirect()->route('empleados')->with('success', 'Empleado creado correctamente');
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
        $empleado = Empleado::findOrFail($id);

        if ($empleado == null) {
            return redirect()->route('empleados');
        }

        return view('admin.empleado.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);

        if ($empleado == null) {
            return redirect()->route('empleados');
        }

        return view('admin.empleado.edit', compact('empleado'));
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
            'nro_documento' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required|date',
            'email' => 'required',
        ]);

        try {
            $empleado = Empleado::findOrFail($id);

            $empleado->nro_documento = $request->get('nro_documento');
            $empleado->nombres = $request->get('nombres');
            $empleado->apellidos = $request->get('apellidos');
            $empleado->fecha_nacimiento = $request->get('fecha_nacimiento');
            $empleado->email = $request->get('email');
            $empleado->telefono = $request->get('telefono');
            $empleado->update();

            return redirect()->route('empleados')->with('success', 'Empleado actualizado correctamente');
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
            $empleado = Empleado::findOrFail($id);

            $empleado->delete();
            return redirect()->route('empleados')->with('success', 'Empleado eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('empleados')->with('error', $th->getMessage());
        }
    }
}
