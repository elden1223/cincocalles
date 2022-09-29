@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <h3>Inventario de producto: Información</h3>
    <div class="col-md-12">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Sucursal</strong></label>
            </div>
            <div class="col-auto">
                {{ $inventario->sucursal }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Producto</strong></label>
            </div>
            <div class="col-auto">
                {{ $inventario->productobodega }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Stock</strong></label>
            </div>
            <div class="col-auto">
                {{ $inventario->stock }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Precio de venta</strong></label>
            </div>
            <div class="col-auto">
                {{ $inventario->precio_venta }}
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-2">
                <a class="btn btn-success" href="{{ route('inventarios') }}"> Volver</a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection