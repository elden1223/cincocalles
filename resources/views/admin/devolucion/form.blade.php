<div class="mb-3">
    <input class="form-control" readonly type="text" value="{{ $detalleventa }}">
</div>

<div class="mb-3">
    <label for="fecha">Fecha <b class="text-danger">*</b></label>
    <input class="form-control @error('fecha') is-invalid @enderror" type="date" name="fecha" value="{{ old('fecha', $devolucion->fecha) }}">
    @error('fecha')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="observaciones">Observaciones</label>
    <textarea class="form-control @error('observaciones') is-invalid @enderror" name="observaciones" rows="5">{{ old('observaciones', $devolucion->observaciones) }}</textarea>
    @error('observaciones')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <input name="detalle_venta_id" type="number" value="{{ $devolucion->detalle_venta_id }}" hidden>
</div>