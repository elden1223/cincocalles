<div class="mb-3">
    <input type="number" name="salida_producto_id" value="{{ $detallesalida->salida_producto_id }}" hidden>    
</div>

<div class="mb-3">
    <label for="producto_bodega_id">Producto <b class="text-danger">*</b></label>
    <select class="form-control @error('producto_bodega_id') is-invalid @enderror" name="producto_bodega_id">
        @foreach ($productos as $item)
        @if($item->id == $detallesalida->producto_bodega_id)
        <option value="{{ $item->id }}" selected> {{$item}}</option>
        @else
        <option value="{{ $item->id }}"> {{$item}}</option>
        @endif
        @endforeach
    </select>
    @error('producto_bodega_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="cantidad">Cantidad <b class="text-danger">*</b></label>
    <input class="form-control @error('cantidad') is-invalid @enderror" type="number" name="cantidad" value="{{ old('cantidad', $detallesalida->cantidad) }}">
    @error('cantidad')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

