@extends('layouts.login-out')

@section('content')
<style>
    body {
        background: #02131f3c; /* Un color de fondo claro o un degradado */
    }

    .card {
        border-radius: 10px; /* Bordes redondeados */
        border: none; /* Sin bordes */
        margin: 0 auto; /* Centrar la tarjeta */
    }

    .card-header, .card-footer {
        border-radius: 10px 10px 0 0; /* Redondeo en la parte superior de la tarjeta */
        border: none; /* Sin bordes */
    }

    .card-footer {
        border-radius: 0 0 10px 10px; /* Redondeo en la parte inferior de la tarjeta */
    }

    .btn-primary {
        background-color: #f44a1c; /* Color del botón */
        border-color: #f44a1c; /* Color del borde del botón */
        border-radius: 50px; /* Bordes redondeados en el botón */
    }

    .btn-primary:hover {
        background-color: #d7391b; /* Color del botón al pasar el mouse */
        border-color: #d7391b;
    }

    .form-control {
        border-radius: 50px; /* Bordes redondeados en los campos de entrada */
        padding-left: 20px; /* Padding interno para el texto */
    }

    .invalid-feedback {
        font-size: 0.875em; /* Tamaño de fuente más pequeño para mensajes de error */
        color: #dc3545; /* Color de los mensajes de error */
    }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                <div class="card-header text-center bg-light" style="background-color: #f8f9fa; border-bottom: none;">
                    <h4 class="text-primary">{{ __('INICIO DE SESION') }}</h4>
                </div>

                <div class="card-body bg-light">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="email" class="form-label">{{ __('Correo Electronico *') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your Username">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label">{{ __('Contraseña *') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Recuerdame') }}</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block" style="background-color: #f44a1c; border-color: #f44a1c;">
                                {{ __('LOGIN') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light d-flex justify-content-between" style="background-color: #f8f9fa; border-top: none;">
                    <a href="{{ route('register') }}" class="text-danger">{{ __("No tienes una cuenta?") }}</a>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-danger">{{ __('Olvidaste tu Contraseña?') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
