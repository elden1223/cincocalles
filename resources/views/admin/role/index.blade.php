@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Roles</h3>
        <div class="mb-3">
            <form action="{{ route('roles') }}" method="get">
                <div class="row">
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="filter" value="{{ $filter }}" placeholder="Buscar por nombre">
                    </div>
                    <div class="col-md-4 text-right">
                        <input class="btn btn-dark" type="submit" value="Buscar">
                        <a class="btn btn-success" href="{{ route('role.create') }}"><i class="fas fa-plus"></i> Crear Nuevo</a>
                    </div>
                </div>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $item)
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('role.show',$item->id) }}"><i class="fas fa-eye"></i> Ver</a></li>
                                <li><a class="dropdown-item" href="{{ route('role.edit',$item->id) }}"><i class="fas fa-edit"></i> Editar</a></li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <button class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </li>
                            </ul>
                        </div>
                        @include('admin.role.modal')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
        {{ $roles->links() }}
        </div>
    </div>
</section>
@endsection