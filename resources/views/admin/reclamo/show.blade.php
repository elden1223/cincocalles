@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <h3>Reclamo: Información</h3>
    <div class="col-md-12">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Número de venta</strong></label>
            </div>
            <div class="col-auto">
                {{ $reclamo->nro_venta }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Descripción</strong></label>
            </div>
            <div class="col-auto">
                {{ $reclamo->descripcion }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Fecha</strong></label>
            </div>
            <div class="col-auto">
                {{ $reclamo->fecha }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Estado</strong></label>
            </div>
            <div class="col-auto">
                {{ $reclamo->estado }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Cliente</strong></label>
            </div>
            <div class="col-auto">
                {{ $reclamo->cliente }}
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-2">
                <a class="btn btn-success" href="{{ route('reclamos') }}"> Volver</a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection