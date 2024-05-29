<div class="row padding-1 p-1">
    <div class="col-md-12">
        <div class="form-group mb-3">
            <label for="username" class="form-label col-form-label">{{ __('Username') }}</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $usuario?->username) }}" id="username">
            {!! $errors->first('username', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        
        <div class="form-group mb-3">
            <label for="nombre_completo" class="form-label col-form-label">{{ __('Nombre completo') }}</label>
            <input type="text" name="nombre_completo" class="form-control @error('nombre_completo') is-invalid @enderror" value="{{ old('nombre_completo', $usuario?->nombre_completo) }}" id="nombre_completo">
            {!! $errors->first('nombre_completo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="estado" class="form-label col-form-label">{{ __('Estado') }}</label>
            <select name="estado" class="form-control @error('estado') is-invalid @enderror" id="estado" required>
                <option value="1" {{ old('estado', $usuario?->estado) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="2" {{ old('estado', $usuario?->estado) == 2 ? 'selected' : '' }}>Inactivo</option>
            </select>
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label col-form-label">{{ __('Correo electrónico') }}</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $usuario?->email) }}" id="email">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="password" class="form-label col-form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" {{$usuario->id? '':'required'}} autocomplete="new-password" placeholder="{{$usuario->id ? 'Sin modificar' : ''}}">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="password-confirm" class="form-label col-form-label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" {{$usuario->id? '':'required'}} autocomplete="new-password" placeholder="{{$usuario->id ? 'Sin modificar' : ''}}">
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <div class="form-check">
                <input type="checkbox" name="is_admin" class="form-check-input @error('is_admin') is-invalid @enderror" id="rol" value="1" {{ old('is_admin', $usuario?->is_admin) == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="rol">{{ __('Usuario con permisos de administración') }}</label>
            </div>
            {!! $errors->first('is_admin', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="mt-2">
        <button type="submit" class="btn btn-primary ">{{ __('Guardar') }}</button>
    </div>
</div>
