@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-registro custom-border">
                <div class="card-header custom-color custom-letraRegistro">{{ __('Editar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="carrera" class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>
                        
                            <div class="btn-group col-md-6">
                                @foreach ($user->usuario_carrera as $carrera)
                                <button class="btn dropdown-toggle" 
                                    type="button" data-toggle="dropdown">{{$carrera->nombre}}<span class="caret"></span>
                                </button>
                                @endforeach
                                <ul class="dropdown-menu">
                                    @foreach($carreras as $carrera)
                                        <li><a href="#">{{$carrera->nombre}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Rol" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>
                        
                            <div class="btn-group col-md-6">
                                @foreach ($user->roles as $rol)
                                <button class="btn dropdown-toggle" 
                                    type="button" data-toggle="dropdown">{{$rol->name}}<span class="caret"></span>
                                </button>
                                @endforeach
                                <ul class="dropdown-menu">
                                    @foreach($roles as $rol)
                                        <li><a href="#">{{$rol->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary custom-registrar">
                                    {{ __('Confirmar') }}
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