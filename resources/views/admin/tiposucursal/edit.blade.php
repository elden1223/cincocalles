@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Tipo de Sucursal: Editar</h3>
        <div class="col-md-12">
            <form action="{{ route('tiposucursal.update', $tiposucursal->id) }}" method="post">
                @csrf
                @include('admin.tiposucursal.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Actualizar">
                    <a class="btn btn-danger" href="{{ route('tiposucursals') }}"> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection