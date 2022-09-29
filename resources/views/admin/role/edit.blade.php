@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Rol: Editar</h3>
        <div class="col-md-12">
            <form action="{{ route('role.update', $role->id) }}" method="post">
                @csrf
                @include('admin.role.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Actualizar">
                    <a class="btn btn-danger" href="{{ route('roles') }}"> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection