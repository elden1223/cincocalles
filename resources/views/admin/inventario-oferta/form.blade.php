<div class="mb-3">
    <label for="oferta_id">Oferta <b class="text-danger">*</b></label>
    <select class="form-control @error('oferta_id') is-invalid @enderror" name="oferta_id">
        @foreach ($ofertas as $item)
        @if($item->id == $inventariooferta->oferta_id)
        <option value="{{ $item->id }}" selected> {{ $item }}</option>
        @else
        <option value="{{ $item->id }}"> {{ $item }}</option>
        @endif
        @endforeach
    </select>
    @error('oferta_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="inventario_id">Producto <b class="text-danger">*</b></label>
    <select class="form-control @error('inventario_id') is-invalid @enderror" name="inventario_id">
        @foreach ($inventarios as $item)
        @if($item->id == $inventariooferta->inventario_id)
        <option value="{{ $item->id }}" selected> {{ $item }}</option>
        @else
        <option value="{{ $item->id }}"> {{ $item }}</option>
        @endif
        @endforeach
    </select>
    @error('inventario_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>