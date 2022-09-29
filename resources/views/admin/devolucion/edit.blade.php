@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Devolución: Editar</h3>
        <div class="col-md-12">
            <form action="{{ route('devolucion.update', $devolucion->id) }}" method="post">
                @csrf
                @include('admin.devolucion.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Actualizar">
                    <a class="btn btn-danger" href="{{ route('devoluciones') }}"> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection