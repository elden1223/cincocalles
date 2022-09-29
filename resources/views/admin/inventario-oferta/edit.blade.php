@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Oferta de producto en inventario: Editar</h3>
        <div class="col-md-12">
            <form action="{{ route('inventariooferta.update', $inventariooferta->id) }}" method="post">
                @csrf
                @include('admin.inventario-oferta.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Actualizar">
                    <a class="btn btn-danger" href="{{ route('inventarioofertas') }}"> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection