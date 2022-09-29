@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Salida de producto: Crear</h3>
        <div class="col-md-12">
            <form action="{{ route('salida.store') }}" method="post">
                @csrf
                @include('admin.salida.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Registrar - Seleccionar productos">
                    <a class="btn btn-danger" href="{{ route('salidas') }}"> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection