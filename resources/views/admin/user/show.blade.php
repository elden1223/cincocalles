@extends('layouts.app-admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <h3>Usuario: Información</h3>
    <div class="col-md-12">
        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Email</strong></label>
            </div>
            <div class="col-auto">
                {{ $user->email }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Empleado</strong></label>
            </div>
            <div class="col-auto">
                {{ $user->empleado }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Sucursal</strong></label>
            </div>
            <div class="col-auto">
                {{ $user->sucursal }}
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-md-2">
                <label class="col-form-label"><strong>Rol</strong></label>
            </div>
            <div class="col-auto">
                {{ $user->rol }}
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-2">
                <a class="btn btn-success" href="{{ route('users') }}"> Volver</a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection