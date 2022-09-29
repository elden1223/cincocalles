<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\InventarioOferta;
use App\Models\Oferta;
use Illuminate\Http\Request;

class InventarioOfertaController extends Controller
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
        if ($request->session()->get('sucursal') == null) {
            return redirect()->route('home')->with('error', 'Selecciona una sucursal');
        }
        $sucursal = $request->session()->get('sucursal');

        $filter = $request->get('filter');
        $inventarioofertas = InventarioOferta::select('inventario_ofertas.*')
            ->join('ofertas as o', 'inventario_ofertas.oferta_id', '=', 'o.id')
            ->join('inventarios as i', 'i.id', '=', 'inventario_ofertas.inventario_id')
            ->where('o.fecha_inicio', 'LIKE', $filter . '%')
            ->where('i.sucursal_id', '=', $sucursal->id)
            ->orderby('o.fecha_fin', 'ASC')
            ->paginate(10);
        return view('admin.inventario-oferta.index', compact('inventarioofertas', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->session()->get('sucursal') == null) {
            return redirect()->route('home')->with('error', 'Selecciona una sucursal');
        }
        $sucursal = $request->session()->get('sucursal');

        $ofertas = Oferta::all();
        $inventarios = Inventario::where('sucursal_id', '=', $sucursal->id)->get();

        $inventariooferta = new InventarioOferta();
        return view('admin.inventario-oferta.create', compact('inventariooferta', 'ofertas', 'inventarios'));
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
            'oferta_id' => 'required',
            'inventario_id' => 'required',
        ]);

        $inventariooferta = $request->all();
        try {
            InventarioOferta::create($inventariooferta);
            return redirect()->route('inventarioofertas')->with('success', 'InventarioOferta creado correctamente');
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
        $inventariooferta = InventarioOferta::findOrFail($id);

        if ($inventariooferta == null) {
            return redirect()->route('inventarioofertas');
        }

        return view('admin.inventario-oferta.show', compact('inventariooferta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->session()->get('sucursal') == null) {
            return redirect()->route('home')->with('error', 'Selecciona una sucursal');
        }
        $sucursal = $request->session()->get('sucursal');

        $ofertas = Oferta::all();
        $inventarios = Inventario::where('sucursal_id', '=', $sucursal->id)->get();

        $inventariooferta = InventarioOferta::findOrFail($id);

        if ($inventariooferta == null) {
            return redirect()->route('inventarioofertas');
        }

        return view('admin.inventario-oferta.edit', compact('inventariooferta', 'ofertas', 'inventarios'));
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
            'oferta_id' => 'required',
            'inventario_id' => 'required',
        ]);

        try {
            $inventariooferta = InventarioOferta::findOrFail($id);

            $inventariooferta->oferta_id = $request->get('oferta_id');
            $inventariooferta->inventario_id = $request->get('inventario_id');
            $inventariooferta->update();

            return redirect()->route('inventarioofertas')->with('success', 'InventarioOferta actualizado correctamente');
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
            $inventariooferta = InventarioOferta::findOrFail($id);

            $inventariooferta->delete();
            return redirect()->route('inventarioofertas')->with('success', 'InventarioOferta eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('inventarioofertas')->with('error', $th->getMessage());
        }
    }
}
