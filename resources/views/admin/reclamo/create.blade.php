@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Reclamo: Crear</h3>
        <div class="col-md-12">
            <form action="{{ route('reclamo.store') }}" method="post">
                @csrf
                @include('admin.reclamo.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Registrar">
                    <a class="btn btn-danger" href="{{ route('reclamos') }}"> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection