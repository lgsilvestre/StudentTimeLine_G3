@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-ajustarVistaPerfil">
                <div class="card-header custom-color custom-perfil">Mi Perfil</div>

                <div class="card-body">   
                    <div class= "custom-foto float-center"></div> 
                    <ul class="btn btn-link float-center custom-olvido custom-perfilElemento" href="{{ route('password.request') }}">
                        {{ __('Cambiar foto de perfil') }} 
                    </ul>              
                    <ul class= "float-left custom-perfilElemento">
                        <a class="custom-negrita">Nombre:</a> 
                        {{$user->name}}
                    </ul>
                    <ul class= "float-left custom-perfilElemento">
                        <a class="custom-negrita">Correo:</a>
                        {{$user->email}}
                    </ul>
                    <button type="button" class="btn btn-link loat-center custom-olvido" data-toggle="modal" data-target="#exampleModal">
                        ¿Desea cambiar su contraseña?
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cambio de Contraseña</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                            <!-- Aqui va el código de las contraseñar -->
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña Antigua') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" placeholder="••••••••••••••" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña Nueva') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" placeholder="••••••••••••••" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar nueva Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" placeholder="••••••••••••••" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
