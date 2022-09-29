<div class="mb-3">
    <label for="nombre">Nombre <b class="text-danger">*</b></label>
    <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" value="{{ old('nombre', $sucursal->nombre) }}">
    @error('nombre')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="direccion">Dirección <b class="text-danger">*</b></label>
    <input class="form-control @error('direccion') is-invalid @enderror" type="text" name="direccion" value="{{ old('direccion', $sucursal->direccion) }}">
    @error('direccion')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="telefono">Teléfono </label>
    <input class="form-control @error('telefono') is-invalid @enderror" type="text" name="telefono" value="{{ old('telefono', $sucursal->telefono) }}">
    @error('telefono')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="descripcion">Descripción </label>
    <input class="form-control @error('descripcion') is-invalid @enderror" type="text" name="descripcion" value="{{ old('descripcion', $sucursal->descripcion) }}">
    @error('descripcion')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <input class="form-control @error('url_logo') is-invalid @enderror" type="text" name="url_logo" value="{{ old('url_logo', $sucursal->url_logo) }}" hidden>
    @error('url_logo')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="tipo_sucursal_id">Tipo de sucursal <b class="text-danger">*</b></label>
    <select class="form-control @error('tipo_sucursal_id') is-invalid @enderror" name="tipo_sucursal_id">
        @foreach ($tipo_sucursals as $item)
        @if($item->id == $sucursal->tipo_sucursal_id)
        <option value="{{ $item->id }}" selected> {{$item}}</option>
        @else
        <option value="{{ $item->id }}"> {{$item}}</option>
        @endif
        @endforeach
    </select>
    @error('tipo_sucursal_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>