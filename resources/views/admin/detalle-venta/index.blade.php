@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">

        <h3>Detalle de venta</h3>

        @if(!$venta->completado)
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

                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if(!$venta->completado)
                                <li>
                                    <button class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('devolucion.create',$item->id) }}"><i class="fas fa-flash"></i> Devolver</a></li>
                            </ul>
                        </div>
                        @include('admin.detalle-venta.modal')
                    </td>
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