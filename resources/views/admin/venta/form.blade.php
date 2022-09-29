
<div class="mb-3">
    <label for="cliente_id">Cliente <b class="text-danger">*</b></label>
    <select class="form-control @error('cliente_id') is-invalid @enderror" name="cliente_id">
        @foreach ($clientes as $item)
        @if($item->id == $venta->cliente_id)
        <option value="{{ $item->id }}" selected> {{$item}}</option>
        @else
        <option value="{{ $item->id }}"> {{$item}}</option>
        @endif
        @endforeach
    </select>
    @error('cliente_id')
    <span class="invalid-feedback" clientee="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="tipo_pago_id">Tipo de pago <b class="text-danger">*</b></label>
    <select class="form-control @error('tipo_pago_id') is-invalid @enderror" name="tipo_pago_id">
        @foreach ($tipopagos as $item)
        @if($item->id == $venta->tipo_pago_id)
        <option value="{{ $item->id }}" selected> {{$item}}</option>
        @else
        <option value="{{ $item->id }}"> {{$item}}</option>
        @endif
        @endforeach
    </select>
    @error('tipo_pago_id')
    <span class="invalid-feedback" tipo_pagoe="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="fecha">Fecha <b class="text-danger">*</b></label>
    <input class="form-control @error('fecha') is-invalid @enderror" type="date" name="fecha" value="{{ old('fecha', $venta->fecha) }}">
    @error('fecha')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
