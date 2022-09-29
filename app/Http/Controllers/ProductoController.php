<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
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
        $productos = Producto::select('productos.*')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->where('productos.nombre', 'LIKE', '%' . $filter . '%')
            ->orWhere('categorias.nombre', 'LIKE', $filter . '%')
            ->orderby('productos.nombre', 'ASC')
            ->paginate(10);
        return view('admin.producto.index', compact('productos', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();

        $producto = new Producto();
        return view('admin.producto.create', compact('producto', 'categorias'));
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
            'nombre' => 'required',
            'unidad_medida' => 'required',
            'categoria_id' => 'required',
        ]);

        $producto = $request->all();
        try {
            Producto::create($producto);
            return redirect()->route('productos')->with('success', 'Producto creado correctamente');
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
        $producto = Producto::findOrFail($id);

        if ($producto == null) {
            return redirect()->route('productos');
        }

        return view('admin.producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = Categoria::all();

        $producto = Producto::findOrFail($id);

        if ($producto == null) {
            return redirect()->route('productos');
        }

        return view('admin.producto.edit', compact('producto', 'categorias'));
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
            'nombre' => 'required',
            'unidad_medida' => 'required',
            'categoria_id' => 'required',
        ]);

        try {
            $producto = Producto::findOrFail($id);

            $producto->nombre = $request->get('nombre');
            $producto->descripcion = $request->get('descripcion');
            $producto->unidad_medida = $request->get('unidad_medida');
            $producto->categoria_id = $request->get('categoria_id');
            $producto->update();

            return redirect()->route('productos')->with('success', 'Producto actualizado correctamente');
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
            $producto = Producto::findOrFail($id);

            $producto->delete();
            return redirect()->route('productos')->with('success', 'Producto eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('productos')->with('error', $th->getMessage());
        }
    }
}
