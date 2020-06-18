@extends('layouts.app')

@section('content')
<div class="custom-espacio"></div>
<div class="custom-espacio"></div>
<div class="custom-espacio"></div>
<div class="custom-espacio"></div>
<div class="custom-espacio"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-border custom-tamanioRecordar">
                <div class="card-header custom-color custom-recuperarSesion">{{ __('Recuperar contraseña') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                            <div class="col-md-6 custom-tamanioCasillaLogin inputWithIcon">
                                <input id="email" type="email" placeholder="ejemplo@utalca.cl" class="custom-ajusteTextoImagen custom-colorCasillas form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary custom-enviarSolicitud">
                                    {{ __('Enviar Solicitud') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
