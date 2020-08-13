@extends('layouts.app')

@section('content')
<div class="custom-espacio"></div>
<div class="custom-espacio"></div>
<div class="custom-espacio"></div>
<div class="container custom-tamanio">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card ">
                <div class="card-header custom-inicioSesion custom-color">{{ __('Student Timeline') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right custom-espesor">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-6 inputWithIcon">
                                <input id="email" type="email" placeholder="ejemplo@utalca.cl" class="custom-colorCasillas custom-ajusteTextoImagen form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contrasenia" class="col-md-4 col-form-label text-md-right custom-espesor">{{ __('Contraseña') }}</label>

                            <div class="col-md-6 inputWithIcon">
                                <input id="password" type="password" placeholder="••••••••••••••" class="custom-colorCasillas custom-ajusteTextoImagen form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <i id="show_password" class="fa fa-eye-slash fa-lg icon"  onclick="mostrarPassword()"></i>

                                <script type="text/javascript">
                                
                                    function mostrarPassword(){
		                                var cambio = document.getElementById("password");
                                    
                                        if(cambio.type == "password"){
			                                cambio.type = "text";
                                        
                                            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                                        }
                                    
                                        else{
			                                cambio.type = "password";
            
                                            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		                                }                           
	                                } 
                                </script>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary custom-color custom-ingresar">
                                    {{ __('Ingresar') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidó su contraseña?') }}
                                    </a>
                                @endif
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
