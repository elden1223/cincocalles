<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetalleSalida;
use App\Models\DetalleVenta;
use App\Models\Inventario;
use App\Models\TipoPago;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
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
        $ventas = Venta::where('nro_venta', 'LIKE', $filter . '%')
            ->where('fecha', 'LIKE', $filter . '%')
            ->paginate(10);
        return view('admin.venta.index', compact('ventas', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipopagos = TipoPago::all();
        $clientes = Cliente::orderby('nro_documento', 'ASC')->get();

        $venta = new Venta();
        return view('admin.venta.create', compact('venta', 'tipopagos', 'clientes'));
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
            'cliente_id' => 'required',
            'tipo_pago_id' => 'required',
            'fecha' => 'required',
        ]);

        $venta = $request->all();
        $venta['nro_venta'] = date('YmdHisu');
        $venta['completado'] = false;
        $venta['total'] = 0;
        $venta['user_id'] = Auth::user()->id;
        try {
            Venta::create($venta);

            $ventas = Venta::where('nro_venta', '=', $venta['nro_venta'])->get();

            if (count($ventas) > 0) {
                return redirect()->route('detalleventas', $ventas[0]->id)->with('success', 'Agrega productos a la venta');
            }

            return back()->with('error', 'No se pudo crear la Venta de producto');
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
        $venta = Venta::findOrFail($id);

        return view('admin.venta.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta = Venta::findOrFail($id);

        $tipopagos = TipoPago::all();
        $clientes = Cliente::orderby('nro_documento', 'ASC')->get();

        return view('admin.venta.edit', compact('venta', 'tipopagos', 'clientes'));
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
            'cliente_id' => 'required',
            'tipo_pago_id' => 'required',
            'fecha' => 'required',
        ]);

        try {
            $venta = Venta::findOrFail($id);

            if ($venta->completado) {
                return redirect()->route('ventas')->with('error', 'Venta ya se encuentra completado. No se puede modificar');
            }

            $venta->fecha = $request->get('fecha');
            $venta->tipo_pago_id = $request->get('tipo_pago_id');
            $venta->update();

            return redirect()->route('ventas')->with('success', 'Venta actualizado correctamente');
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
            $venta = Venta::findOrFail($id);

            if ($venta->completado) {
                return redirect()->route('ventas')->with('error', 'Venta ya se encuentra completado, no se puede eliminar');
            }

            $detalleventas = DetalleVenta::where('venta_id', '=', $venta->id)->get();
            foreach ($detalleventas as $item) {
                $item->inventario->stock += $item->cantidad;
                $item->inventario->update();
                $item->delete();
            }

            $venta->delete();
            return redirect()->route('ventas')->with('success', 'Venta eliminado correctamente');
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
            $venta = Venta::findOrFail($id);

            if ($venta->completado) {
                return redirect()->route('ventas')->with('error', 'Venta ya se encuentra completado, no se puede eliminar');
            }

            $detalleventas = DetalleVenta::where('venta_id', '=', $id)->get();
            if(count($detalleventas) == 0){
                return back()->with('error', 'No tiene productos la venta');
            }

            $venta->completado = true;
            $venta->update();

            return redirect()->route('ventas')->with('success', 'Venta procesado correctamente');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
