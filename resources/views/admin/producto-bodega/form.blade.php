<div class="mb-3">
    <label for="nro_lote">Número de lote </label>
    <input class="form-control @error('nro_lote') is-invalid @enderror" type="text" name="nro_lote" value="{{ old('nro_lote', $productobodega->nro_lote) }}">
    @error('nro_lote')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="codigo_barra">Código de barra</label>
    <input class="form-control @error('codigo_barra') is-invalid @enderror" type="text" name="codigo_barra" value="{{ old('codigo_barra', $productobodega->codigo_barra) }}">
    @error('codigo_barra')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="precio_compra">Precio de compra <b class="text-danger">*</b></label>
    <input class="form-control @error('precio_compra') is-invalid @enderror" type="number" step="0.01" name="precio_compra" value="{{ old('precio_compra', $productobodega->precio_compra) }}">
    @error('precio_compra')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="precio_venta_base">Precio de venta base <b class="text-danger">*</b></label>
    <input class="form-control @error('precio_venta_base') is-invalid @enderror" type="number" step="0.01" name="precio_venta_base" value="{{ old('precio_venta_base', $productobodega->precio_venta_base) }}">
    @error('precio_venta_base')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="stock">Stock <b class="text-danger">*</b></label>
    <input class="form-control @error('stock') is-invalid @enderror" type="number" name="stock" value="{{ old('stock', $productobodega->stock) }}">
    @error('stock')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="fecha_vencimiento">Fecha de vencimiento </label>
    <input class="form-control @error('fecha_vencimiento') is-invalid @enderror" type="date" name="fecha_vencimiento" value="{{ old('fecha_vencimiento', $productobodega->fecha_vencimiento) }}">
    @error('fecha_vencimiento')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="producto_id">Producto <b class="text-danger">*</b></label>
    <select class="form-control @error('producto_id') is-invalid @enderror" name="producto_id">
        @foreach ($productos as $item)
        @if($item->id == $productobodega->producto_id)
        <option value="{{ $item->id }}" selected> {{$item}}</option>
        @else
        <option value="{{ $item->id }}"> {{$item}}</option>
        @endif
        @endforeach
    </select>
    @error('producto_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
