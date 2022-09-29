@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Inventario: Crear</h3>
        <div class="col-md-12">
            <form action="{{ route('inventario.store') }}" method="post">
                @csrf
                @include('admin.inventario.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Registrar">
                    <a class="btn btn-danger" href="{{ route('inventarios') }}"> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection