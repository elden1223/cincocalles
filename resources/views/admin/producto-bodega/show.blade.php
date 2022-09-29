@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <h3>Producto bodega: Información</h3>
    <div class="col-md-12">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Número de lote</strong></label>
            </div>
            <div class="col-auto">
                {{ $productobodega->nro_lote }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Código de barra</strong></label>
            </div>
            <div class="col-auto">
                {{ $productobodega->codigo_barra }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Precio compra</strong></label>
            </div>
            <div class="col-auto">
                {{ $productobodega->precio_compra }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Precio venta</strong></label>
            </div>
            <div class="col-auto">
                {{ $productobodega->precio_venta }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Stock</strong></label>
            </div>
            <div class="col-auto">
                {{ $productobodega->stock }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Fecha de vencimiento</strong></label>
            </div>
            <div class="col-auto">
                {{ $productobodega->fecha_vencimiento }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Producto</strong></label>
            </div>
            <div class="col-auto">
                {{ $productobodega->producto }}
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-2">
                <a class="btn btn-success" href="{{ route('productobodegas') }}"> Volver</a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection