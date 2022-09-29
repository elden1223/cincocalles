<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
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
        $categorias = Categoria::where('nombre', 'LIKE', $filter . '%')->paginate(10);
        return view('admin.categoria.index', compact('categorias', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = new Categoria();
        return view('admin.categoria.create', compact('categoria'));
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
            'nombre' => 'required|unique:categorias',
        ]);

        $categoria = $request->all();
        try {
            Categoria::create($categoria);
            return redirect()->route('categorias')->with('success', 'Categoría creado correctamente');
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
        $categoria = Categoria::findOrFail($id);

        if ($categoria == null) {
            return redirect()->route('categorias');
        }

        return view('admin.categoria.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        if ($categoria == null) {
            return redirect()->route('categorias');
        }

        return view('admin.categoria.edit', compact('categoria'));
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
        ]);

        try {
            $categoria = Categoria::findOrFail($id);

            $categoria->nombre = $request->get('nombre');
            $categoria->update();

            return redirect()->route('categorias')->with('success', 'Categoría actualizado correctamente');
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
            $categoria = Categoria::findOrFail($id);

            $categoria->delete();
            return redirect()->route('categorias')->with('success', 'Categoría eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('categorias')->with('error', $th->getMessage());
        }
    }
}
