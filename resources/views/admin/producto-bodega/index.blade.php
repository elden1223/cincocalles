@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Porductos en Bodega</h3>
        <div class="mb-3">
            <form action="{{ route('productobodegas') }}" method="get">
                <div class="row">
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="filter" value="{{ $filter }}" placeholder="Buscar por nombre, número de lote o código de barras">
                    </div>
                    <div class="col-md-4 text-right">
                        <input class="btn btn-dark" type="submit" value="Buscar">
                        <a class="btn btn-success" href="{{ route('productobodega.create') }}"><i class="fas fa-plus"></i> Crear Nuevo</a>
                    </div>
                </div>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Nro. Lote</th>
                    <th>Cód. Barras</th>
                    <th>Precio compra</th>
                    <th>Precio venta base</th>
                    <th>Stock</th>
                    <th>Fecha vencimiento</th>
                    <th>Producto</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productobodegas as $item)
                <tr>
                    <td>{{ $item->nro_lote }}</td>
                    <td>{{ $item->codigo_barra }}</td>
                    <td>{{ $item->precio_compra }}</td>
                    <td>{{ $item->precio_venta_base }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->fecha_vencimiento }}</td>
                    <td>{{ $item->producto }}</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('productobodega.show',$item->id) }}"><i class="fas fa-eye"></i> Ver</a></li>
                                <li><a class="dropdown-item" href="{{ route('productobodega.edit',$item->id) }}"><i class="fas fa-edit"></i> Editar</a></li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <button class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </li>
                            </ul>
                        </div>
                        @include('admin.producto-bodega.modal')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $productobodegas->links() }}
        </div>
    </div>
</section>
@endsection