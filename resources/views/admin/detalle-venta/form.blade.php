<div class="mb-3">
    <input type="number" name="venta_id" value="{{ $detalleventa->venta_id }}" hidden>    
</div> 

<div class="mb-3">
    <label for="inventario_id">Producto <b class="text-danger">*</b></label>
    <select class="form-control @error('inventario_id') is-invalid @enderror" name="inventario_id">
        @foreach ($productos as $item)
        @if($item->id == $detalleventa->inventario_id)
        <option value="{{ $item->id }}" selected> {{$item}}</option>
        @else
        <option value="{{ $item->id }}"> {{$item}}</option>
        @endif
        @endforeach
    </select>
    @error('inventario_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="cantidad">Cantidad <b class="text-danger">*</b></label>
    <input class="form-control @error('cantidad') is-invalid @enderror" type="number" name="cantidad" value="{{ old('cantidad', $detalleventa->cantidad) }}">
    @error('cantidad')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

