@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h2>Sucursales</h2>
        <hr>
        @foreach ($sucursales as $item)
        <div class="card">
            <div class="card-header">
            {{ $item->nombre }}
            </div>
            <div class="card-body">
                <p>                    
                    {{ $item->descripcion }} <br>
                    Dirección: {{ $item->direccion }} <br>
                    Teléfono: {{ $item->telefono }} <br>
                    Tipo: {{ $item->tiposucursal }} <br>
                </p>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <a class="btn btn-primary" href="{{ route('home.seleccionar', $item->id) }}">Seleccionar</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
