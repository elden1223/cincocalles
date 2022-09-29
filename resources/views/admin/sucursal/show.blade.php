@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <h3>Sucursal: Información</h3>
    <div class="col-md-12">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Nombre</strong></label>
            </div>
            <div class="col-auto">
                {{ $sucursal->nombre }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Dirección</strong></label>
            </div>
            <div class="col-auto">
                {{ $sucursal->direccion }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Teléfono</strong></label>
            </div>
            <div class="col-auto">
                {{ $sucursal->telefono }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Descripción</strong></label>
            </div>
            <div class="col-auto">
                {{ $sucursal->descripcion }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Tipo de sucursal</strong></label>
            </div>
            <div class="col-auto">
                {{ $sucursal->TipoSucursal }}
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-2">
                <a class="btn btn-success" href="{{ route('sucursals') }}"> Volver</a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection