<div class="mb-3">
    <label for="nro_venta">Número de venta </label>
    <input class="form-control @error('nro_venta') is-invalid @enderror" type="text" name="nro_venta" value="{{ old('nro_venta', $reclamo->nro_venta) }}">
    @error('nro_venta')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="descripcion">Descripción <b class="text-danger">*</b></label>
    <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" rows="5">{{ old('descripcion', $reclamo->descripcion) }}</textarea>
    @error('descripcion')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="fecha">Fecha </label>
    <input class="form-control @error('fecha') is-invalid @enderror" type="date" name="fecha" value="{{ old('fecha', $reclamo->fecha) }}">
    @error('fecha')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="estado">Estado <b class="text-danger">*</b></label>
    <select class="form-control @error('estado') is-invalid @enderror" name="estado">
        @foreach ($estados as $item)
        @if($item == $reclamo->estado)
        <option value="{{ $item }}" selected> {{$item}}</option>
        @else
        <option value="{{ $item }}"> {{$item}}</option>
        @endif
        @endforeach
    </select>
    @error('estado')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="cliente_id">Cliente <b class="text-danger">*</b></label>
    <select class="form-control @error('cliente_id') is-invalid @enderror" name="cliente_id">
        @foreach ($clientes as $item)
        @if($item->id == $reclamo->cliente_id)
        <option value="{{ $item->id }}" selected> {{$item}}</option>
        @else
        <option value="{{ $item->id }}"> {{$item}}</option>
        @endif
        @endforeach
    </select>
    @error('cliente_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>