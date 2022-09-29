<?php

namespace App\Http\Controllers;

use App\Models\DetalleSalida;
use App\Models\Inventario;
use App\Models\SalidaProducto;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class SalidaProductoController extends Controller
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
        if($request->session()->get('sucursal') == null){
            return redirect()->route('home')->with('error', 'Selecciona una sucursal');
        }
        $sucursal = $request->session()->get('sucursal');

        $filter = $request->get('filter');        
        $salidas = SalidaProducto::where('nro_salida', 'LIKE', $filter . '%')
            ->where('sucursal_id', '=', $sucursal->id)
            ->paginate(10);
        return view('admin.salida.index', compact('salidas', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salida = new SalidaProducto();
        return view('admin.salida.create', compact('salida'));
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
        ]);

        if($request->session()->get('sucursal') == null){
            return redirect()->route('home')->with('error', 'Selecciona una sucursal');
        }
        $sucursal = $request->session()->get('sucursal');

        $salida = $request->all();
        $salida['sucursal_id'] = $sucursal->id;
        $salida['nro_salida'] = date('YmdHisu');
        $salida['procesado'] = $request->get('procesado') == 'on' ? true : false;
        try {
            SalidaProducto::create($salida);

            $salidas = SalidaProducto::where('nro_salida', '=', $salida['nro_salida'])->get();

            if (count($salidas) > 0) {
                return redirect()->route('detallesalidas', $salidas[0]->id)->with('success', 'SalidaProducto creado correctamente');
            }

            return back()->with('error', 'No se pudo crear la Salida de producto');
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
        $salida = SalidaProducto::findOrFail($id);

        if ($salida == null) {
            return redirect()->route('salidas');
        }

        return view('admin.salida.show', compact('salida'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salida = SalidaProducto::findOrFail($id);

        if ($salida == null) {
            return redirect()->route('salidas');
        }

        return view('admin.salida.edit', compact('salida'));
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
        ]);

        if($request->session()->get('sucursal') == null){
            return redirect()->route('home')->with('error', 'Selecciona una sucursal');
        }
        $sucursal = $request->session()->get('sucursal');

        try {
            $salida = SalidaProducto::findOrFail($id);

            if ($salida->procesado) {
                return redirect()->route('salidas')->with('error', 'SalidaProducto ya se encuentra procesado. No se puede modificar');
            }

            $salida->fecha = $request->get('fecha');
            $salida->observaciones = $request->get('observaciones');
            $salida->personal_cargo = $request->get('personal_cargo');
            $salida->procesado = $request->get('procesado') == 'on' ? true : false;
            $salida->sucursal_id = $sucursal->id;
            $salida->update();

            return redirect()->route('salidas')->with('success', 'SalidaProducto actualizado correctamente');
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
            $salida = SalidaProducto::findOrFail($id);

            if ($salida->procesado) {
                return redirect()->route('salidas')->with('error', 'SalidaProducto ya se encuentra procesado, no se puede eliminar');
            }

            $salida->delete();
            return redirect()->route('salidas')->with('success', 'SalidaProducto eliminado correctamente');
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
    public function procesar($id)
    {
        try {
            $salida = SalidaProducto::findOrFail($id);

            if ($salida->procesado) {
                return redirect()->route('salidas')->with('error', 'SalidaProducto ya se encuentra procesado, no se puede eliminar');
            }

            $detallesalidas = DetalleSalida::where('salida_producto_id', '=', $id)->get();
            foreach ($detallesalidas as $item) {
                $inventario = null;
                try {
                    $inventario = Inventario::where('sucursal_id', '=', $salida->sucursal_id)
                        ->where('producto_bodega_id', '=', $item->producto_bodega_id)
                        ->firstOrFail();
                } catch (\Throwable $th) {
                }

                if ($inventario == null) {
                    $inventario = [];
                    $inventario['sucursal_id'] = $salida->sucursal_id;
                    $inventario['producto_bodega_id'] = $item->producto_bodega_id;
                    $inventario['stock'] = $item->cantidad;
                    $inventario['precio_venta'] = $item->productobodega->precio_venta_base;
                    Inventario::create($inventario);
                } else {
                    $inventario->stock += $item->cantidad;
                    $inventario->update();
                }
            }

            $salida->procesado = true;
            $salida->update();

            return redirect()->route('salidas')->with('success', 'SalidaProducto procesado correctamente');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
