<?php

namespace App\Http\Controllers;

use App\Models\TipoPago;
use Illuminate\Http\Request;

class TipoPagoController extends Controller
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
        $tipopagos = TipoPago::where('nombre', 'LIKE', $filter . '%')->paginate(10);
        return view('admin.tipo-pago.index', compact('tipopagos', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipopago = new TipoPago();
        return view('admin.tipo-pago.create', compact('tipopago'));
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
            'nombre' => 'required|unique:tipo_pagos',
        ]);

        $tipopago = $request->all();
        try {
            TipoPago::create($tipopago);
            return redirect()->route('tipopagos')->with('success', 'Tipo de pago creado correctamente');
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
        $tipopago = TipoPago::findOrFail($id);

        return view('admin.tipo-pago.show', compact('tipopago'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipopago = TipoPago::findOrFail($id);

        return view('admin.tipo-pago.edit', compact('tipopago'));
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
            $tipopago = TipoPago::findOrFail($id);

            $tipopago->nombre = $request->get('nombre');
            $tipopago->update();

            return redirect()->route('tipopagos')->with('success', 'Tipo de pago actualizado correctamente');
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
            $tipopago = TipoPago::findOrFail($id);

            $tipopago->delete();
            return redirect()->route('tipopagos')->with('success', 'Tipo de pago eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('tipopagos')->with('error', $th->getMessage());
        }
    }
}
