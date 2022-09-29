@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <h3>Empleado: Información</h3>
    <div class="col-md-12">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Número de documento</strong></label>
            </div>
            <div class="col-auto">
                {{ $empleado->nro_documento }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Nombres</strong></label>
            </div>
            <div class="col-auto">
                {{ $empleado->nombres }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Apellidos</strong></label>
            </div>
            <div class="col-auto">
                {{ $empleado->apellidos }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Fecha de nacimiento</strong></label>
            </div>
            <div class="col-auto">
                {{ $empleado->fecha_nacimiento }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Email</strong></label>
            </div>
            <div class="col-auto">
                {{ $empleado->email }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Teléfono</strong></label>
            </div>
            <div class="col-auto">
                {{ $empleado->telefono }}
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-2">
                <a class="btn btn-success" href="{{ route('empleados') }}"> Volver</a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection