<div class="mb-3">
    <label for="nombre">Nombre <b class="text-danger">*</b></label>
    <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}">
    @error('nombre')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="descripcion">Descripcion</label>
    <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" rows="5">{{ old('descripcion') }}</textarea>
    @error('descripcion')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="unidad_medida">Unidad de medida <b class="text-danger">*</b></label>
    <input class="form-control @error('unidad_medida') is-invalid @enderror" type="text" name="unidad_medida" value="{{ old('unidad_medida', $producto->unidad_medida) }}">
    @error('unidad_medida')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="categoria_id">Categoría <b class="text-danger">*</b></label>
    <select class="form-control @error('categoria_id') is-invalid @enderror" name="categoria_id">
        @foreach ($categorias as $item)
        @if($item->id == $producto->categoria_id)
        <option value="{{ $item->id }}" selected> {{$item}}</option>
        @else
        <option value="{{ $item->id }}"> {{$item}}</option>
        @endif
        @endforeach
    </select>
    @error('categoria_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
