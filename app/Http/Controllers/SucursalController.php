<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\TipoSucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
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
        $sucursals = Sucursal::where('nombre', 'LIKE', $filter . '%')->paginate(10);
        return view('admin.sucursal.index', compact('sucursals', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_sucursals = TipoSucursal::all();

        $sucursal = new Sucursal();
        return view('admin.sucursal.create', compact('sucursal', 'tipo_sucursals'));
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
            'nombre' => 'required',
            'direccion' => 'required',
        ]);

        $sucursal = $request->all();
        try {
            Sucursal::create($sucursal);
            return redirect()->route('sucursals')->with('success', 'Sucursal creado correctamente');
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
        $sucursal = Sucursal::findOrFail($id);

        if ($sucursal == null) {
            return redirect()->route('sucursals');
        }

        return view('admin.sucursal.show', compact('sucursal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo_sucursals = TipoSucursal::all();

        $sucursal = Sucursal::findOrFail($id);

        if ($sucursal == null) {
            return redirect()->route('sucursals');
        }

        return view('admin.sucursal.edit', compact('sucursal', 'tipo_sucursals'));
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
            'nombre' => 'required',
            'direccion' => 'required',
        ]);
        try {
            $sucursal = Sucursal::findOrFail($id);

            $sucursal->nombre = $request->get('nombre');
            $sucursal->direccion = $request->get('direccion');
            $sucursal->telefono = $request->get('telefono');
            $sucursal->descripcion = $request->get('descripcion');
            $sucursal->url_logo = $request->get('url_logo');
            $sucursal->tipo_sucursal_id = $request->get('tipo_sucursal_id');
            $sucursal->update();

            return redirect()->route('sucursals')->with('success', 'Sucursal actualizado correctamente');
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
            $sucursal = Sucursal::findOrFail($id);

            $sucursal->delete();
            return redirect()->route('sucursals')->with('success', 'Sucursal eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('sucursals')->with('error', $th->getMessage());
        }
    }
}
