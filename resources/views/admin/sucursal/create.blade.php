@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Sucursal: Crear</h3>
        <div class="col-md-12">
            <form action="{{ route('sucursal.store') }}" method="post">
                @csrf
                @include('admin.sucursal.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Registrar">
                    <a class="btn btn-danger" href="{{ route('sucursals') }}"> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection