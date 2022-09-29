<div class="mb-3">
    <label for="fecha">Fecha <b class="text-danger">*</b></label>
    <input class="form-control @error('fecha') is-invalid @enderror" type="date" name="fecha" value="{{ old('fecha', $salida->fecha) }}">
    @error('fecha')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="observaciones">Observaciones</label>
    <textarea class="form-control @error('observaciones') is-invalid @enderror" name="observaciones" rows="5">{{ old('observaciones') }}</textarea>
    @error('observaciones')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="personal_cargo">Personal a cargo </label>
    <input class="form-control @error('personal_cargo') is-invalid @enderror" type="text" name="personal_cargo" value="{{ old('personal_cargo', $salida->personal_cargo) }}">
    @error('personal_cargo')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="procesado">Procesado </label>
    @if($salida->procesado)
    <input class="@error('procesado') is-invalid @enderror" type="checkbox" name="procesado" checked>
    @else
    <input class="@error('procesado') is-invalid @enderror" type="checkbox" name="procesado">
    @endif

    @error('procesado')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>