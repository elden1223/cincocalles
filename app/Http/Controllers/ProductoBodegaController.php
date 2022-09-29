<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ProductoBodega;
use Illuminate\Http\Request;

class ProductoBodegaController extends Controller
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
        $productobodegas = ProductoBodega::select('producto_bodegas.*')
            ->join('productos', 'producto_bodegas.producto_id', '=', 'productos.id')
            ->where('productos.nombre', 'LIKE', '%' . $filter . '%')
            ->orWhere('producto_bodegas.nro_lote', 'LIKE', $filter . '%')
            ->orWhere('producto_bodegas.codigo_barra', 'LIKE', $filter . '%')
            ->orderby('productos.nombre', 'ASC')
            ->paginate(10);
        return view('admin.producto-bodega.index', compact('productobodegas', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::all();

        $productobodega = new ProductoBodega();
        return view('admin.producto-bodega.create', compact('productobodega', 'productos'));
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
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta_base' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'producto_id' => 'required',
        ]);

        $productobodega = $request->all();
        try {
            ProductoBodega::create($productobodega);
            return redirect()->route('productobodegas')->with('success', 'Producto creado correctamente');
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
        $productobodega = ProductoBodega::findOrFail($id);

        if ($productobodega == null) {
            return redirect()->route('productobodegas');
        }

        return view('admin.producto-bodega.show', compact('productobodega'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productos = Producto::all();

        $productobodega = ProductoBodega::findOrFail($id);

        if ($productobodega == null) {
            return redirect()->route('productobodegas');
        }

        return view('admin.producto-bodega.edit', compact('productobodega', 'productos'));
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
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta_base' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'producto_id' => 'required',
        ]);

        try {
            $productobodega = ProductoBodega::findOrFail($id);

            $productobodega->nro_lote = $request->get('nro_lote');
            $productobodega->codigo_barra = $request->get('codigo_barra');
            $productobodega->precio_compra = $request->get('precio_compra');
            $productobodega->precio_venta_base = $request->get('precio_venta_base');
            $productobodega->stock = $request->get('stock');
            $productobodega->fecha_vencimiento = $request->get('fecha_vencimiento');
            $productobodega->producto_id = $request->get('producto_id');
            $productobodega->update();

            return redirect()->route('productobodegas')->with('success', 'Producto actualizado correctamente');
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
            $productobodega = ProductoBodega::findOrFail($id);

            $productobodega->delete();
            return redirect()->route('productobodegas')->with('success', 'Producto eliminado correctamente');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
