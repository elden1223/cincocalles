@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
        <h3>Inventario de productos</h3>
        <div class="mb-3">
            <form action="{{ route('inventarios') }}" method="get">
                <div class="row">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="filter" value="{{ $filter }}" placeholder="Buscar por Nombre, Número de lote o Código de barra">
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="estado">
                            <option value="">Seleccionar estado</option>
                            @foreach($estados as $item)
                            @if($estado == $item)
                            <option value="{{ $item }}" selected>{{ $item }}</option>
                            @else
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 text-right">
                        <input class="btn btn-dark" type="submit" value="Buscar">
                        <a class="btn btn-success" href="{{ route('inventario.create') }}"><i class="fas fa-plus"></i> Crear Nuevo</a>
                    </div>
                </div>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Sucursal</th>
                    <th>Producto</th>
                    <th>Stock</th>
                    <th>Precio venta</th>
                    <th>% Descuento</th>
                    <th>Fecha vencimiento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventarios as $item)
                <tr>
                    <td>{{ $item->sucursal }}</td>
                    <td>{{ $item->productobodega }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->precio_venta }}</td>
                    @if($ofertas->contains('inventario_id', $item->id))
                    <td class="text-danger"><strong>{{ $ofertas->where('inventario_id', '=', $item->id)->get(0)->porc_descuento * 100 }} %<strong></td>
                    @else
                    <td>Sin oferta</td>
                    @endif
                    <td>{{ $item->productobodega->fecha_vencimiento }}</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('inventario.show',$item->id) }}"><i class="fas fa-eye"></i> Ver</a></li>
                                <li><a class="dropdown-item" href="{{ route('inventario.edit',$item->id) }}"><i class="fas fa-edit"></i> Editar</a></li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <button class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </li>
                            </ul>
                        </div>
                        @include('admin.inventario.modal')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $inventarios->links() }}
        </div>
    </div>
</section>
@endsection