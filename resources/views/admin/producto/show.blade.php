@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <h3>Producto: Información</h3>
    <div class="col-md-12">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Nombre</strong></label>
            </div>
            <div class="col-auto">
                {{ $producto->nombre }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Descripción</strong></label>
            </div>
            <div class="col-auto">
                {{ $producto->descripcion }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Unidad de medida</strong></label>
            </div>
            <div class="col-auto">
                {{ $producto->unidad_medida }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Categoría</strong></label>
            </div>
            <div class="col-auto">
                {{ $producto->categoria }}
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-2">
                <a class="btn btn-success" href="{{ route('productos') }}"> Volver</a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection