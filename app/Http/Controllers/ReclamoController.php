<?php

namespace App\Http\Controllers;

use App\Models\Reclamo;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ReclamoController extends Controller
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
        $reclamos = Reclamo::where('estado', 'LIKE', $filter . '%')
            ->orWhere('fecha', 'LIKE', $filter . '%')
            ->orWhere('nro_venta', 'LIKE', $filter . '%')
            ->orderby('fecha', 'DESC')
            ->orderby('estado', 'ASC')
            ->paginate(10);
        return view('admin.reclamo.index', compact('reclamos', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = ["Espera", "Observación", "Cerrado"];
        $clientes = Cliente::all();

        $reclamo = new Reclamo();
        return view('admin.reclamo.create', compact('reclamo', 'clientes', 'estados'));
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
            'descripcion' => 'required',
            'fecha' => 'required',
            'estado' => 'required',
            'cliente_id' => 'required',
        ]);

        $reclamo = $request->all();
        try {
            Reclamo::create($reclamo);
            return redirect()->route('reclamos')->with('success', 'Reclamo creado correctamente');
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
        $reclamo = Reclamo::findOrFail($id);

        if ($reclamo == null) {
            return redirect()->route('reclamos');
        }

        return view('admin.reclamo.show', compact('reclamo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estados = ["Espera", "Observación", "Cerrado"];
        $clientes = Cliente::all();

        $reclamo = Reclamo::findOrFail($id);

        if ($reclamo == null) {
            return redirect()->route('reclamos');
        }

        return view('admin.reclamo.edit', compact('reclamo', 'clientes', 'estados'));
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
            'descripcion' => 'required',
            'fecha' => 'required',
            'estado' => 'required',
            'cliente_id' => 'required',
        ]);

        try {
            $reclamo = Reclamo::findOrFail($id);

            $reclamo->nro_venta = $request->get('nro_venta');
            $reclamo->descripcion = $request->get('descripcion');
            $reclamo->fecha = $request->get('fecha');
            $reclamo->estado = $request->get('estado');
            $reclamo->cliente_id = $request->get('cliente_id');
            $reclamo->update();

            return redirect()->route('reclamos')->with('success', 'Reclamo actualizado correctamente');
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
            $reclamo = Reclamo::findOrFail($id);

            $reclamo->delete();
            return redirect()->route('reclamos')->with('success', 'Reclamo eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('reclamos')->with('error', $th->getMessage());
        }
    }
}
