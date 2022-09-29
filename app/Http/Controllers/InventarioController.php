<?php

namespace App\Http\Controllers;

use App\Models\DetalleSalida;
use App\Models\Inventario;
use App\Models\InventarioOferta;
use App\Models\ProductoBodega;
use App\Models\Sucursal;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
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
        $estado = $request->get('estado');
        $fecha = date('Y-m-d');

        $estados = ['Vencido', 'Con stock', 'Sin stock'];
        $inventarios = [];

        switch ($estado) {
            case 'Vencido':
                $inventarios = Inventario::join('sucursals as s', 's.id', '=', 'inventarios.sucursal_id')
                    ->join('producto_bodegas as pb', 'inventarios.producto_bodega_id', '=', 'pb.id')
                    ->join('productos as p', 'p.id', '=', 'pb.producto_id')
                    ->where('s.id', '=', $sucursal->id)
                    ->where(function ($query) use ($filter) {
                        $query->where('p.nombre', 'LIKE', '%' . $filter . '%')
                            ->orWhere('pb.nro_lote', 'LIKE', $filter . '%')
                            ->orWhere('pb.codigo_barra', 'LIKE', $filter . '%');
                    })
                    ->where('pb.fecha_vencimiento', '<=', $fecha)
                    ->select('inventarios.*')
                    ->orderby('inventarios.updated_at', 'DESC')
                    ->paginate(10);
                break;
            case 'Sin stock':
                $inventarios = Inventario::join('sucursals as s', 's.id', '=', 'inventarios.sucursal_id')
                    ->join('producto_bodegas as pb', 'inventarios.producto_bodega_id', '=', 'pb.id')
                    ->join('productos as p', 'p.id', '=', 'pb.producto_id')
                    ->where('s.id', '=', $sucursal->id)
                    ->where(function ($query) use ($filter) {
                        $query->where('p.nombre', 'LIKE', '%' . $filter . '%')
                            ->orWhere('pb.nro_lote', 'LIKE', $filter . '%')
                            ->orWhere('pb.codigo_barra', 'LIKE', $filter . '%');
                    })
                    ->where('inventarios.stock', '=', '0')
                    ->select('inventarios.*')
                    ->orderby('inventarios.updated_at', 'DESC')
                    ->paginate(10);
                break;
            case 'Con stock':
                $inventarios = Inventario::join('sucursals as s', 's.id', '=', 'inventarios.sucursal_id')
                    ->join('producto_bodegas as pb', 'inventarios.producto_bodega_id', '=', 'pb.id')
                    ->join('productos as p', 'p.id', '=', 'pb.producto_id')
                    ->where('s.id', '=', $sucursal->id)
                    ->where(function ($query) use ($filter) {
                        $query->where('p.nombre', 'LIKE', '%' . $filter . '%')
                            ->orWhere('pb.nro_lote', 'LIKE', $filter . '%')
                            ->orWhere('pb.codigo_barra', 'LIKE', $filter . '%');
                    })
                    ->where('inventarios.stock', '>', '0')
                    ->select('inventarios.*')
                    ->orderby('inventarios.stock', 'ASC')
                    ->orderby('inventarios.updated_at', 'DESC')                    
                    ->paginate(10);
                break;
            default:
                $inventarios = Inventario::join('sucursals as s', 's.id', '=', 'inventarios.sucursal_id')
                    ->join('producto_bodegas as pb', 'inventarios.producto_bodega_id', '=', 'pb.id')
                    ->join('productos as p', 'p.id', '=', 'pb.producto_id')
                    ->where('s.id', '=', $sucursal->id)
                    ->where(function ($query) use ($filter) {
                        $query->where('p.nombre', 'LIKE', '%' . $filter . '%')
                            ->orWhere('pb.nro_lote', 'LIKE', $filter . '%')
                            ->orWhere('pb.codigo_barra', 'LIKE', $filter . '%');
                    })
                    ->select('inventarios.*')
                    ->orderby('inventarios.updated_at', 'DESC')
                    ->paginate(10);
                break;
        }

        $ofertas = InventarioOferta::join('ofertas as o', 'o.id', '=', 'inventario_ofertas.oferta_id')
            ->join('inventarios as i', 'i.id', '=', 'inventario_ofertas.inventario_id')
            ->where('i.sucursal_id', '=', $sucursal->id)
            ->where('o.fecha_inicio', '<=', $fecha)
            ->where('o.fecha_fin', '>=', $fecha)
            ->select('inventario_ofertas.*')
            ->orderby('o.porc_descuento', 'DESC')            
            ->get();

        return view('admin.inventario.index', compact('inventarios', 'ofertas', 'estados', 'filter', 'estado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventario = new Inventario();

        $productobodegas = ProductoBodega::all();
        return view('admin.inventario.create', compact('inventario', 'productobodegas'));
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
            'producto_bodega_id' => 'required',
            'stock' => 'required|integer|min:0',
            'precio_venta' => 'required|numeric|min:0',
        ]);

        if ($request->session()->get('sucursal') == null) {
            return redirect()->route('home')->with('error', 'Selecciona una sucursal');
        }
        $sucursal = $request->session()->get('sucursal');

        if (count(Inventario::where([
            ['producto_bodega_id', '=', $request->get('producto_bodega_id')],
            ['sucursal_id', '=', $sucursal->id],
        ])->get()) > 0) {
            return back()->with('error', 'Ya existe el producto en el inventario');
        }

        $inventario = $request->all();
        $inventario['sucursal_id'] = $sucursal->id;
        try {
            Inventario::create($inventario);

            return redirect()->route('inventarios')->with('success', 'Inventario creado correctamente');
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
        $inventario = Inventario::findOrFail($id);

        return view('admin.inventario.show', compact('inventario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventario = Inventario::findOrFail($id);

        $productobodegas = ProductoBodega::all();
        return view('admin.inventario.edit', compact('inventario', 'productobodegas'));
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
            'producto_bodega_id' => 'required',
            'stock' => 'required|integer|min:0',
            'precio_venta' => 'required|numeric|min:0',
        ]);

        if ($request->session()->get('sucursal') == null) {
            return redirect()->route('home')->with('error', 'Selecciona una sucursal');
        }
        $sucursal = $request->session()->get('sucursal');

        try {
            $inventario = Inventario::findOrFail($id);

            $inventario->stock = $request->get('stock');
            $inventario->precio_venta = $request->get('precio_venta');
            $inventario->update();

            return redirect()->route('inventarios')->with('success', 'Inventario actualizado correctamente');
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
            $inventario = Inventario::findOrFail($id);

            $inventario->delete();
            return redirect()->route('inventarios')->with('success', 'Inventario eliminado correctamente');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
