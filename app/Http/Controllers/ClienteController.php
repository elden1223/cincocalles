<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
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
        $clientes = Cliente::where('nro_documento', 'LIKE', $filter . '%')
            ->orderby('nro_documento', 'ASC')
            ->paginate(10);
        return view('admin.cliente.index', compact('clientes', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente = new Cliente();
        return view('admin.cliente.create', compact('cliente'));
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
            'nro_documento' => 'required:unique:clientes',
            'nombres' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required|date',
            'email' => 'required|unique:clientes',
        ]);

        $cliente = $request->all();
        try {
            Cliente::create($cliente);
            return redirect()->route('clientes')->with('success', 'Cliente creado correctamente');
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
        $cliente = Cliente::findOrFail($id);

        if ($cliente == null) {
            return redirect()->route('clientes');
        }

        return view('admin.cliente.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        if ($cliente == null) {
            return redirect()->route('clientes');
        }

        return view('admin.cliente.edit', compact('cliente'));
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
            'nro_documento' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required|date',
            'email' => 'required',
        ]);

        try {
            $cliente = Cliente::findOrFail($id);

            $cliente->nro_documento = $request->get('nro_documento');
            $cliente->nombres = $request->get('nombres');
            $cliente->apellidos = $request->get('apellidos');
            $cliente->fecha_nacimiento = $request->get('fecha_nacimiento');
            $cliente->email = $request->get('email');
            $cliente->telefono = $request->get('telefono');
            $cliente->update();

            return redirect()->route('clientes')->with('success', 'Cliente actualizado correctamente');
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
            $cliente = Cliente::findOrFail($id);

            $cliente->delete();
            return redirect()->route('clientes')->with('success', 'Cliente eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('clientes')->with('error', $th->getMessage());
        }
    }
}
