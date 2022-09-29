<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Inventario;
use App\Models\InventarioOferta;
use App\Models\Venta;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
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
    public function index(Request $request, $id)
    {

        if ($request->session()->get('sucursal') == null) {
            return redirect()->route('home')->with('error', 'Selecciona una sucursal');
        }
        $sucursal = $request->session()->get('sucursal');

        $venta = Venta::findOrFail($id);

        $detalleventa = new DetalleVenta();
        $detalleventa->venta_id = $id;

        $fecha = date('Y-m-d');

        $productos = Inventario::join('producto_bodegas as pb', 'pb.id', '=', 'inventarios.producto_bodega_id')
            ->where('inventarios.stock', '>', '0')
            ->where('inventarios.sucursal_id', '=', $sucursal->id)
            ->where(function ($query) use ($fecha) {
                $query->wherenull('pb.fecha_vencimiento')
                    ->orwhere('pb.fecha_vencimiento', '>=', $fecha);
            })
            ->orderby('inventarios.updated_at', 'DESC')
            ->select('inventarios.*')
            ->get();

        $detalleventas = DetalleVenta::where('venta_id', '=', $id)->paginate(10);

        return view('admin.detalle-venta.index', compact('detalleventa', 'detalleventas', 'productos', 'venta'));
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
            'venta_id' => 'required',
            'inventario_id' => 'required',
            'cantidad' => 'required|integer|min:0',
        ]);


        $venta = Venta::findOrFail($request->get('venta_id'));

        if ($venta->procesado) {
            return back()->with('error', 'Esta Venta de productos ya fue completado. No se admite cambios');
        }

        $detalle = $request->all();
        $detalle_existente = null;

        $inventario = Inventario::findOrFail($detalle['inventario_id']);

        try {
            $detalle_existente = DetalleVenta::where('venta_id', '=', $detalle['venta_id'])
                ->where('inventario_id', '=', $detalle['inventario_id'])->firstOrFail();
        } catch (\Throwable $th) {
        }

        if ($detalle_existente != null) {
            $inventario->stock += $detalle_existente->cantidad;
        }

        if ($inventario->stock < $detalle['cantidad']) {
            return back()->with('error', 'No hay stock suficiente. ');
        }

        $fecha = date('Y-m-d');

        try {

            $ofertas = InventarioOferta::join('ofertas as o', 'o.id', '=', 'inventario_ofertas.oferta_id')
                ->where('inventario_ofertas.inventario_id', '=', $detalle['inventario_id'])
                ->where('o.fecha_inicio', '<=', $fecha)
                ->where('o.fecha_fin', '>=', $fecha)
                ->orderby('o.porc_descuento', 'DESC')
                ->select('inventario_ofertas.*')
                ->get();
            $descuento = 0;

            if (count($ofertas) > 0) {
                $descuento = round($detalle['cantidad'] * $inventario->precio_venta * $ofertas->get(0)->porc_descuento, 2);
            }

            if ($detalle_existente != null) {
                $detalle_existente->cantidad = $request->get('cantidad');
                $detalle_existente->precio = $inventario->precio_venta;
                $detalle_existente->descuento = $descuento;
                $detalle_existente->update();
            } else {
                $detalle['precio'] = $inventario->precio_venta;
                $detalle['descuento'] = $descuento;
                DetalleVenta::create($detalle);
            }

            $venta->total += $inventario->precio_venta * $detalle['cantidad'] - $descuento;
            $venta->update();

            $inventario->stock -= $request->get('cantidad');
            $inventario->update();

            return redirect()->route('detalleventas', $venta->id)->with('success', 'Producto agregado al detalle'. $request->get('inventario_id'). $detalle['inventario_id']);
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
            $detalleventa = DetalleVenta::findOrFail($id);

            if ($detalleventa->venta->procesado) {
                return back()->with('error', 'Esta Venta de productos ya fue procesado. No se admite cambios');
            }

            $detalleventa->inventario->stock += $detalleventa->cantidad;
            $detalleventa->inventario->update();

            $detalleventa->venta->total -= $detalleventa->precio * $detalleventa->cantidad - $detalleventa->descuento;
            $detalleventa->venta->update();

            $detalleventa->delete();
            return redirect()->route('detalleventas', $detalleventa->venta_id)->with('success', 'Detalle Venta eliminado correctamente');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
