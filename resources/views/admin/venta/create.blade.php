@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Venta de producto: Crear</h3>
        <div class="col-md-12">
            <form action="{{ route('venta.store') }}" method="post">
                @csrf
                @include('admin.venta.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Seleccionar productos">
                    <a class="btn btn-danger" href="{{ route('ventas') }}"> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection