@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <h3>Oferta: Información</h3>
    <div class="col-md-12">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Nombre</strong></label>
            </div>
            <div class="col-auto">
                {{ $oferta->nombre }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Fecha de inicio</strong></label>
            </div>
            <div class="col-auto">
                {{ $oferta->fecha_inicio }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Fecha fin</strong></label>
            </div>
            <div class="col-auto">
                {{ $oferta->fecha_fin }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Porcentaje descuento</strong></label>
            </div>
            <div class="col-auto">
                {{ $oferta->porc_descuento }}
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-2">
                <a class="btn btn-success" href="{{ route('ofertas') }}"> Volver</a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection