<?php

namespace App\Http\Controllers;

use App\Models\TipoSucursal;
use Illuminate\Http\Request;

class TipoSucursalController extends Controller
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
        $tiposucursals = TipoSucursal::where('nombre', 'LIKE', $filter.'%')->paginate(10);
        return view('admin.tiposucursal.index', compact('tiposucursals', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposucursal = new TipoSucursal();
        return view('admin.tiposucursal.create', compact('tiposucursal'));
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
            'nombre' => 'required|unique:tipo_sucursals',
        ]);

        $tiposucursal = $request->all();
        try {
            TipoSucursal::create($tiposucursal);
            return redirect()->route('tiposucursals')->with('success', 'Tipo de Sucursal creado correctamente');
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
        $tiposucursal = TipoSucursal::findOrFail($id);

        if ($tiposucursal == null) {
            return redirect()->route('tiposucursals');
        }

        return view('admin.tiposucursal.show', compact('tiposucursal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tiposucursal = TipoSucursal::findOrFail($id);

        if ($tiposucursal == null) {
            return redirect()->route('tiposucursals');
        }

        return view('admin.tiposucursal.edit', compact('tiposucursal'));
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
        ]);

        try {
        $tiposucursal = TipoSucursal::findOrFail($id);
        
            $tiposucursal->nombre = $request->get('nombre');
            $tiposucursal->update();

            return redirect()->route('tiposucursals')->with('success', 'Tipo de Sucursal actualizado correctamente');
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
        $tiposucursal = TipoSucursal::findOrFail($id);
        
            $tiposucursal->delete();
            return redirect()->route('tiposucursals')->with('success', 'Tipo de Sucursal eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('tiposucursals')->with('error', $th->getMessage());
        }
    }
}
