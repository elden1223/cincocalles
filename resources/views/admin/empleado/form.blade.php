<div class="mb-3">
    <label for="nro_documento">Número de documento <b class="text-danger">*</b></label>
    <input class="form-control @error('nro_documento') is-invalid @enderror" type="text" name="nro_documento" value="{{ old('nro_documento', $empleado->nro_documento) }}">
    @error('nro_documento')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="nombres">Nombres <b class="text-danger">*</b></label>
    <input class="form-control @error('nombres') is-invalid @enderror" type="text" name="nombres" value="{{ old('nombres', $empleado->nombres) }}">
    @error('nombres')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="apellidos">Apellidos <b class="text-danger">*</b></label>
    <input class="form-control @error('apellidos') is-invalid @enderror" type="text" name="apellidos" value="{{ old('apellidos', $empleado->apellidos) }}">
    @error('apellidos')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="fecha_nacimiento">Fecha de nacimiento <b class="text-danger">*</b></label>
    <input class="form-control @error('fecha_nacimiento') is-invalid @enderror" type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $empleado->fecha_nacimiento) }}">
    @error('fecha_nacimiento')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="email">Email <b class="text-danger">*</b></label>
    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email', $empleado->email) }}">
    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="telefono">Teléfono </label>
    <input class="form-control @error('telefono') is-invalid @enderror" type="text" name="telefono" value="{{ old('telefono', $empleado->telefono) }}">
    @error('telefono')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>