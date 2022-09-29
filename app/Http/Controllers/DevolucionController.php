<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;

class DevolucionController extends Controller
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
        $devoluciones = Devolucion::where('fecha', 'LIKE', $filter . '%')
            ->orderby('updated_at', 'DESC')
            ->paginate(10);
        return view('admin.devolucion.index', compact('devoluciones', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $detalleventa = DetalleVenta::findOrFail($id);

        $devolucion = new Devolucion();
        $devolucion->detalle_venta_id = $detalleventa->id;

        return view('admin.devolucion.create', compact('devolucion', 'detalleventa'));
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
            'fecha' => 'required',
            'detalle_venta_id' => 'required',
        ]);

        $devolucion = $request->all();
        $devolucion['aprobado'] = true;
        try {
            Devolucion::create($devolucion);
            return redirect()->route('devoluciones')->with('success', 'Devolución creado correctamente');
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
        $devolucion = Devolucion::findOrFail($id);

        return view('admin.devolucion.show', compact('devolucion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $devolucion = Devolucion::findOrFail($id);
        $detalleventa = $devolucion->detalleventa;

        return view('admin.devolucion.edit', compact('devolucion', 'detalleventa'));
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
            'fecha' => 'required',
            'detalle_venta_id' => 'required',
        ]);

        try {
            $devolucion = Devolucion::findOrFail($id);

            $devolucion->fecha = $request->get('fecha');
            $devolucion->observaciones = $request->get('observaciones');
            $devolucion->aprobado = true;
            $devolucion->detalle_venta_id = $request->get('detalle_venta_id');
            $devolucion->update();

            return redirect()->route('devoluciones')->with('success', 'Devolución actualizado correctamente');
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
            $devolucion = Devolucion::findOrFail($id);

            $devolucion->delete();
            return redirect()->route('devoluciones')->with('success', 'Devolución eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('devoluciones')->with('error', $th->getMessage());
        }
    }
}
