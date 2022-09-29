@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <h3>Devolución: Información</h3>
    <div class="col-md-12">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Venta</strong></label>
            </div>
            <div class="col-auto">
                {{ $devolucion->detalleventa->venta }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Producto</strong></label>
            </div>
            <div class="col-auto">
                {{ $devolucion->detalleventa->inventario }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Cantidad</strong></label>
            </div>
            <div class="col-auto">
                {{ $devolucion->detalleventa->cantidad }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Estado</strong></label>
            </div>
            <div class="col-auto">
                {{ $devolucion->aprobado? 'Aprobado': 'Espera' }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Fecha</strong></label>
            </div>
            <div class="col-auto">
                {{ $devolucion->fecha }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Observaciones</strong></label>
            </div>
            <div class="col-auto">
                {{ $devolucion->observaciones }}
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-2">
                <a class="btn btn-success" href="{{ route('devoluciones') }}"> Volver</a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection