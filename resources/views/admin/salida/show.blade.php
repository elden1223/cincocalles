@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <h3>Producto: Información</h3>
    <div class="col-md-12">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Nro. Salida</strong></label>
            </div>
            <div class="col-auto">
                {{ $salida->nro_salida }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Fecha</strong></label>
            </div>
            <div class="col-auto">
                {{ $salida->fecha }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Observaciones</strong></label>
            </div>
            <div class="col-auto">
                {{ $salida->observaciones }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Personal a cargo</strong></label>
            </div>
            <div class="col-auto">
                {{ $salida->personal_cargo }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Procesado</strong></label>
            </div>
            <div class="col-auto">
                {{ $salida->procesado? 'Si': 'No' }}
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{ route('detallesalidas', $salida->id) }}"> Ver detalle</a>
                <a class="btn btn-success" href="{{ route('salidas') }}"> Volver</a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection