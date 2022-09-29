@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Porductos</h3>
        <div class="mb-3">
            <form action="{{ route('salidas') }}" method="get">
                <div class="row">
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="filter" value="{{ $filter }}" placeholder="Buscar por Número de salida">
                    </div>
                    <div class="col-md-4 text-right">
                        <input class="btn btn-dark" type="submit" value="Buscar">
                        <a class="btn btn-success" href="{{ route('salida.create') }}"><i class="fas fa-plus"></i> Crear Nuevo</a>
                    </div>
                </div>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Nro. salida</th>
                    <th>Fecha</th>
                    <th>Personal a cargo</th>
                    <th>Procesado</th>
                    <th>Sucursal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salidas as $item)
                <tr>
                    <td>{{ $item->nro_salida }}</td>
                    <td>{{ $item->fecha }}</td>
                    <td>{{ $item->personal_cargo }}</td>
                    <td>{{ $item->procesado? 'Si': 'No' }}</td>
                    <td>{{ $item->sucursal }}</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('salida.show',$item->id) }}"><i class="fas fa-eye"></i> Ver</a></li>
                                <li><a class="dropdown-item" href="{{ route('detallesalidas',$item->id) }}"><i class="fas fa-eye"></i> Ver detalle</a></li>
                                @if(!$item->procesado)
                                <li><a class="dropdown-item" href="{{ route('salida.edit',$item->id) }}"><i class="fas fa-edit"></i> Editar</a></li>
                                <div class="dropdown-divider"></div>                                
                                <li><a class="dropdown-item" href="{{ route('salida.procesar',$item->id) }}"><i class="fas fa-edit"></i> Procesar</a></li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <button class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </li>
                                @endif                                
                            </ul>
                        </div>
                        @include('admin.salida.modal')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $salidas->links() }}
        </div>
    </div>
</section>
@endsection