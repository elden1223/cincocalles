@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Venta de Productos</h3>
        <div class="mb-3">
            <form action="{{ route('ventas') }}" method="get">
                <div class="row">
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="filter" value="{{ $filter }}" placeholder="Buscar por Número de venta o fecha (yyyy-mm-dd)">
                    </div>
                    <div class="col-md-4 text-right">
                        <input class="btn btn-dark" type="submit" value="Buscar">
                        <a class="btn btn-success" href="{{ route('venta.create') }}"><i class="fas fa-plus"></i> Crear Nuevo</a>
                    </div>
                </div>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Nro. venta</th>
                    <th>Cliente</th>
                    <th>Tipo de pago</th>
                    <th>Vendedor</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $item)
                <tr>
                    <td>{{ $item->nro_venta }}</td>
                    <td>{{ $item->cliente }}</td>
                    <td>{{ $item->tipopago }}</td>
                    <td>{{ $item->user->empleado }}</td>
                    <td>{{ $item->fecha }}</td>
                    <td>{{ $item->total }}</td>
                    @if($item->completado)
                    <td class="text-success">Completado</td>
                    @else
                    <td class="text-danger">Esperando</td>
                    @endif
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('venta.show',$item->id) }}"><i class="fas fa-eye"></i> Ver</a></li>
                                <li><a class="dropdown-item" href="{{ route('detalleventas',$item->id) }}"><i class="fas fa-eye"></i> Ver detalle</a></li>
                                @if(!$item->completado)
                                <li><a class="dropdown-item" href="{{ route('venta.edit',$item->id) }}"><i class="fas fa-edit"></i> Editar</a></li>
                                <div class="dropdown-divider"></div>                                
                                <li><a class="dropdown-item" href="{{ route('venta.procesar',$item->id) }}"><i class="fas fa-edit"></i> Procesar</a></li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <button class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </li>
                                @endif                                
                            </ul>
                        </div>
                        @include('admin.venta.modal')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $ventas->links() }}
        </div>
    </div>
</section>
@endsection