@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">

        @if(!$salida_producto->procesado)
        <h3>Detalle de salida: Crear</h3>
        <div class="col-md-12">
            <form action="{{ route('detallesalida.store') }}" method="post">
                @csrf
                @include('admin.detalle-salida.form')
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="action" value="Agregar al detalle de salida">
                </div>
            </form>
        </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detallesalidas as $item)
                <tr>
                    <td>{{ $item->productobodega }}</td>
                    <td>{{ $item->cantidad }}</td>
                    @if(!$salida_producto->procesado)
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
                        @include('admin.detalle-salida.modal')
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $detallesalidas->links() }}
        </div>
    </div>
</section>
@endsection