@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Producto: Crear</h3>
        <div class="col-md-12">
            <form action="{{ route('producto.store') }}" method="post">
                @csrf
                @include('admin.producto.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Registrar">
                    <a class="btn btn-danger" href="{{ route('productos') }}"> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection