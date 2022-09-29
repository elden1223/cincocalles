@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Empleado: Editar</h3>
        <div class="col-md-12">
            <form action="{{ route('empleado.update', $empleado->id) }}" method="post">
                @csrf
                @include('admin.empleado.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Actualizar">
                    <a class="btn btn-danger" href="{{ route('empleados') }}"> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection