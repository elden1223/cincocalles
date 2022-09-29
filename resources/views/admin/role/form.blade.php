<div class="mb-3">
    <label for="nombre">Nombre <b class="text-danger">*</b></label>
    <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" value="{{ old('nombre', $role->nombre) }}">
    @error('nombre')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>