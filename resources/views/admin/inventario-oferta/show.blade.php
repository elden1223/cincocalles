@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <h3>Oferta de producto en inventario: Información</h3>
    <div class="col-md-12">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Producto</strong></label>
            </div>
            <div class="col-auto">
                {{ $inventariooferta->inventario }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Oferta</strong></label>
            </div>
            <div class="col-auto">
                {{ $inventariooferta->oferta }}
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-2">
                <a class="btn btn-success" href="{{ route('inventarioofertas') }}"> Volver</a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection