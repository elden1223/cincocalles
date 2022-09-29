<div class="mb-3">
    <label for="producto_bodega_id">Producto <b class="text-danger">*</b></label>
    <select class="form-control @error('producto_bodega_id') is-invalid @enderror" name="producto_bodega_id">
        @foreach ($productobodegas as $item)
        @if($item->id == $inventario->producto_bodega_id)
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
    <label for="stock">Stock </label>
    <input class="form-control @error('stock') is-invalid @enderror" type="number" name="stock" value="{{ old('stock', $inventario->stock) }}">
    @error('stock')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="precio_venta">Número de venta </label>
    <input class="form-control @error('precio_venta') is-invalid @enderror" type="number" name="precio_venta" step="0.01" value="{{ old('precio_venta', $inventario->precio_venta) }}">
    @error('precio_venta')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>