@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Tipos de pago</h3>
        <div class="mb-3">
            <form action="{{ route('tipopagos') }}" method="get">
                <div class="row">
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="filter" value="{{ $filter }}" placeholder="Buscar por nombre">
                    </div>
                    <div class="col-md-4 text-right">
                        <input class="btn btn-dark" type="submit" value="Buscar">
                        <a class="btn btn-success" href="{{ route('tipopago.create') }}"><i class="fas fa-plus"></i> Crear Nuevo</a>
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
                @foreach ($tipopagos as $item)
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('tipopago.show',$item->id) }}"><i class="fas fa-eye"></i> Ver</a></li>
                                <li><a class="dropdown-item" href="{{ route('tipopago.edit',$item->id) }}"><i class="fas fa-edit"></i> Editar</a></li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <button class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </li>
                            </ul>
                        </div>
                        @include('admin.tipo-pago.modal')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $tipopagos->links() }}
        </div>
    </div>
</section>
@endsection