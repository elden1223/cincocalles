@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Devoluciones</h3>
        <div class="mb-3">
            <form action="{{ route('devoluciones') }}" method="get">
                <div class="row">
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="filter" value="{{ $filter }}" placeholder="Buscar por fecha (yyyy-mm-dd)">
                    </div>
                    <div class="col-md-4 text-right">
                        <input class="btn btn-dark" type="submit" value="Buscar">
                    </div>
                </div>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>                    
                    <th>Venta</th>
                    <th>Producto</th>
                    <th>Fecha</th>
                    <th>Observaciones</th>                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($devoluciones as $item)
                <tr>
                    <td>{{ $item->detalleventa->venta }}</td>
                    <td>{{ $item->detalleventa->inventario }}</td>
                    <td>{{ $item->fecha }}</td>
                    <td>{{ $item->observaciones }}</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('devolucion.show',$item->id) }}"><i class="fas fa-eye"></i> Ver</a></li>
                                <li><a class="dropdown-item" href="{{ route('devolucion.edit',$item->id) }}"><i class="fas fa-edit"></i> Editar</a></li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <button class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </li>
                            </ul>
                        </div>
                        @include('admin.devolucion.modal')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $devoluciones->links() }}
        </div>
    </div>
</section>
@endsection