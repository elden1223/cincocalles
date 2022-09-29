
<div class="mb-3">
    <label for="descripcion">Descripción <b class="text-danger">*</b></label>
    <input class="form-control @error('descripcion') is-invalid @enderror" type="text" name="descripcion" value="{{ old('descripcion', $oferta->descripcion) }}">
    @error('descripcion')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="mb-3">
    <label for="fecha_inicio">Fecha de inicio <b class="text-danger">*</b></label>
    <input class="form-control @error('fecha_inicio') is-invalid @enderror" type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $oferta->fecha_inicio) }}">
    @error('fecha_inicio')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="fecha_fin">Fecha fin <b class="text-danger">*</b></label>
    <input class="form-control @error('fecha_fin') is-invalid @enderror" type="date" name="fecha_fin" value="{{ old('fecha_fin', $oferta->fecha_fin) }}">
    @error('fecha_fin')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="porc_descuento">Porcentaje de descuento (Ejemplo: 0.5 -> 50%) <b class="text-danger">*</b></label>
    <input class="form-control @error('porc_descuento') is-invalid @enderror" type="number" name="porc_descuento" step="0.01" value="{{ old('porc_descuento', $oferta->porc_descuento) }}">
    @error('porc_descuento')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

