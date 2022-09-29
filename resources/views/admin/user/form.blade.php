<div class="mb-3">
    <label for="email">Email <b class="text-danger">*</b></label>
    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email', $user->email) }}">
    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="password">Password <b class="text-danger">*</b></label>
    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" value="{{ old('password') }}">
    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="sucursal_id">Sucursal <b class="text-danger">*</b></label>
    <select class="form-control @error('sucursal_id') is-invalid @enderror" name="sucursal_id">
        @foreach ($sucursals as $item)
        @if($item->id == $user->sucursal_id)
        <option value="{{ $item->id }}" selected> {{$item}}</option>
        @else
        <option value="{{ $item->id }}"> {{$item}}</option>
        @endif
        @endforeach
    </select>
    @error('sucursal_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="empleado_id">Empleado <b class="text-danger">*</b></label>
    <select class="form-control @error('empleado_id') is-invalid @enderror" name="empleado_id">
        @foreach ($empleados as $item)
        @if($item->id == $user->empleado_id)
        <option value="{{ $item->id }}" selected> {{$item}}</option>
        @else
        <option value="{{ $item->id }}"> {{$item}}</option>
        @endif
        @endforeach
    </select>
    @error('empleado_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-3">
    <label for="rol_id">Rol <b class="text-danger">*</b></label>
    <select class="form-control @error('rol_id') is-invalid @enderror" name="rol_id">
        @foreach ($roles as $item)
        @if($item->id == $user->rol_id)
        <option value="{{ $item->id }}" selected> {{$item}}</option>
        @else
        <option value="{{ $item->id }}"> {{$item}}</option>
        @endif
        @endforeach
    </select>
    @error('rol_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>