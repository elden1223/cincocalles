<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;

class OfertaController extends Controller
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
        $ofertas = Oferta::where('descripcion', 'LIKE', $filter . '%')
            ->orwhere('fecha_inicio', 'LIKE', $filter . '%')
            ->orderby('updated_at', 'DESC')
            ->paginate(10);
        return view('admin.oferta.index', compact('ofertas', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oferta = new Oferta();
        return view('admin.oferta.create', compact('oferta'));
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
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'porc_descuento' => 'required|numeric|min:0',
        ]);

        $oferta = $request->all();
        try {
            Oferta::create($oferta);
            return redirect()->route('ofertas')->with('success', 'Oferta creado correctamente');
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
        $oferta = Oferta::findOrFail($id);

        if ($oferta == null) {
            return redirect()->route('ofertas');
        }

        return view('admin.oferta.show', compact('oferta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oferta = Oferta::findOrFail($id);

        if ($oferta == null) {
            return redirect()->route('ofertas');
        }

        return view('admin.oferta.edit', compact('oferta'));
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
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'porc_descuento' => 'required|numeric|min:0',
        ]);

        try {
            $oferta = Oferta::findOrFail($id);

            $oferta->descripcion = $request->get('descripcion');
            $oferta->fecha_inicio = $request->get('fecha_inicio');
            $oferta->fecha_fin = $request->get('fecha_fin');
            $oferta->porc_descuento = $request->get('porc_descuento');
            $oferta->update();

            return redirect()->route('ofertas')->with('success', 'Oferta actualizado correctamente');
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
            $oferta = Oferta::findOrFail($id);

            $oferta->delete();
            return redirect()->route('ofertas')->with('success', 'Oferta eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('ofertas')->with('error', $th->getMessage());
        }
    }
}
