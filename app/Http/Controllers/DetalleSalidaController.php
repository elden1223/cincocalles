<?php

namespace App\Http\Controllers;

use App\Models\DetalleSalida;
use App\Models\ProductoBodega;
use App\Models\SalidaProducto;
use Illuminate\Http\Request;

class DetalleSalidaController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $salida_producto = SalidaProducto::find($id);

        if ($salida_producto == null) {
            return back()->with('error', 'Salida de productos no válida');
        }

        $detallesalida = new DetalleSalida();
        $detallesalida->salida_producto_id = $id;

        $productos = ProductoBodega::all();
        $detallesalidas = DetalleSalida::where('salida_producto_id', '=', $id)->paginate(10);

        return view('admin.detalle-salida.index', compact('detallesalida', 'detallesalidas', 'productos', 'salida_producto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'salida_producto_id' => 'required',
            'producto_bodega_id' => 'required',
            'cantidad' => 'required|integer|min:0',
        ]);


        $salida_producto = SalidaProducto::find($request->get('salida_producto_id'));

        if ($salida_producto == null) {
            return back()->with('error', 'Salida de productos no válida');
        }

        if ($salida_producto->procesado) {
            return back()->with('error', 'Esta Salida de productos ya fue procesado. No se admite cambios');
        }

        $detalle = $request->all();
        $detalle_existente = null;

        $productobodega = ProductoBodega::findOrFail($detalle['producto_bodega_id']);
        if ($productobodega == null) {
            return back()->with('error', 'No existe el producto seleccionado');
        }

        try {
            $detalle_existente = DetalleSalida::where('salida_producto_id', '=', $detalle['salida_producto_id'])
                ->where('producto_bodega_id', '=', $detalle['producto_bodega_id'])->firstOrFail();
        } catch (\Throwable $th) {
        }

        if ($detalle_existente != null) {
            $productobodega->stock += $detalle_existente->cantidad;
        }

        if ($productobodega->stock < $detalle['cantidad']) {
            return back()->with('error', 'No hay stock suficiente. ');
        }

        try {
            if ($detalle_existente != null) {
                $detalle_existente->cantidad = $request->get('cantidad');
                $detalle_existente->update();
            } else {
                DetalleSalida::create($detalle);
            }
            $productobodega->stock -= $request->get('cantidad');
            $productobodega->update();

            return redirect()->route('detallesalidas', $salida_producto->id)->with('success', 'Producto agregado al detalle');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
            $detallesalida = DetalleSalida::findOrFail($id);

            if ($detallesalida->salidaproducto->procesado) {
                return back()->with('error', 'Esta Salida de productos ya fue procesado. No se admite cambios');
            }

            $detallesalida->delete();
            return redirect()->route('detallesalidas', $detallesalida->salida_producto_id)->with('success', 'Detalle Salida eliminado correctamente');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
