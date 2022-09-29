@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">

        @if(!$venta->completado)
        <h3>Detalle de venta: Crear</h3>
        <div class="col-md-12">
            <form action="{{ route('detalleventa.store') }}" method="post">
                @csrf
                @include('admin.detalle-venta.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Agregar al detalle de venta">
                    <a class="btn btn-success" href="{{ route('venta.procesar', $venta->id) }}"><i class="fas fa-save"></i> Procesar venta</a>
                    <a class="btn btn-danger" href="{{ route('venta.cancel', $venta->id) }}"><i class="fas fa-trash"></i> Cancelar venta</a>
                </div>
            </form>
        </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio venta</th>
                    <th>Subtotal</th>
                    <th>Descuento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalleventas as $item)
                <tr>
                    <td>{{ $item->inventario }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->precio }}</td>
                    <td>{{ $item->precio * $item->cantidad }}</td>
                    <td>{{ $item->descuento }}</td>
                    @if(!$venta->completado)
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <button class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </li>
                            </ul>
                        </div>
                        @include('admin.detalle-venta.modal')
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $detalleventas->links() }}
        </div>
        <div>
            <h3>Total a pagar: {{ $venta->total }}</h3>
        </div>
    </div>
</section>
@endsection