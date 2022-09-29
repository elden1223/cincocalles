@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <h3>Cliente: Información</h3>
    <div class="col-md-12">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Número de documento</strong></label>
            </div>
            <div class="col-auto">
                {{ $cliente->nro_documento }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Nombres</strong></label>
            </div>
            <div class="col-auto">
                {{ $cliente->nombres }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Apellidos</strong></label>
            </div>
            <div class="col-auto">
                {{ $cliente->apellidos }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Fecha de nacimiento</strong></label>
            </div>
            <div class="col-auto">
                {{ $cliente->fecha_nacimiento }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Email</strong></label>
            </div>
            <div class="col-auto">
                {{ $cliente->email }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Teléfono</strong></label>
            </div>
            <div class="col-auto">
                {{ $cliente->telefono }}
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-2">
                <a class="btn btn-success" href="{{ route('clientes') }}"> Volver</a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection