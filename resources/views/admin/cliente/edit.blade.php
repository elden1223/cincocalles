@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Cliente: Editar</h3>
        <div class="col-md-12">
            <form action="{{ route('cliente.update', $cliente->id) }}" method="post">
                @csrf
                @include('admin.cliente.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Actualizar">
                    <a class="btn btn-danger" href="{{ route('clientes') }}"> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection