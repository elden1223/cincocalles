@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <h3>Venta de productos: Información</h3>
    <div class="col-md-12">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Nro. Venta</strong></label>
            </div>
            <div class="col-auto">
                {{ $venta->nro_venta }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Cliente</strong></label>
            </div>
            <div class="col-auto">
                {{ $venta->cliente }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Tipo de pago</strong></label>
            </div>
            <div class="col-auto">
                {{ $venta->tipopago }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Vendedor</strong></label>
            </div>
            <div class="col-auto">
                {{ $venta->user }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Fecha</strong></label>
            </div>
            <div class="col-auto">
                {{ $venta->fecha }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Total</strong></label>
            </div>
            <div class="col-auto">
                {{ $venta->total }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Estado</strong></label>
            </div>
            <div class="col-auto">
                {{ $venta->completado? 'Completado': 'Esperando' }}
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{ route('detalleventas', $venta->id) }}"> Ver detalle</a>
                <a class="btn btn-success" href="{{ route('ventas') }}"> Volver</a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection