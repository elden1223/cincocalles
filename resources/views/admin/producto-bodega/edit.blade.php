@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Producto bodega: Editar</h3>
        <div class="col-md-12">
            <form action="{{ route('productobodega.update', $productobodega->id) }}" method="post">
                @csrf
                @include('admin.producto-bodega.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Actualizar">
                    <a class="btn btn-danger" href="{{ route('productobodegas') }}"> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection