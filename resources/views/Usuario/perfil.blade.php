@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card margen-card">
                <div class="card-header custom-color custom-recuperarSesion">Mi Perfil</div>
                <div class="card-body"> 
                    <div class="row">
                        <div class= "custom-foto float-center">
                            <img  class="imagen" src="../images/{{$user->imagen}}" alt="">
                        </div> 
                    </div>
                    <div clas="row">
                            <button type="button" style="margin-left:60px" class="btn btn-link float-center custom-olvido" data-toggle="modal" data-target="#modalProfile">
                                Cambiar foto de perfil
                            </button>
                            
                    </div>
                    <div class="row">
                        <ul  >
                            <a class="custom-negrita">Nombre:</a> 
                            {{$user->name}}
                        </ul>
                    </div>
                    <div class="row">
                        <ul >
                            <a style="text-align: center;"  class="custom-negrita">Correo:</a>
                            {{$user->email}}
                        </ul>
                    </div>
                    <div class="row">
                        <button type="button" style="margin-left:auto;margin-right:auto" class="btn btn-link float-center custom-olvido" data-toggle="modal" data-target="#exampleModal">
                            ¿Desea cambiar su contraseña?
                        </button>   
                    </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal cambiar foto -->
<div class="modal fade" id="modalProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header custom-color">
                <h5 class="modal-title" id="modalProfileLabel" style="color:white">Cambio de Fotografia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.postProfileImage') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Aqui va el código de las contraseñar -->
                    @csrf
                    <div class="form-group row">
                        <label for="foto" class="col-md-2 col-form-label text-md-right fileinput">{{ __('Foto') }}</label>
                        <div class="col-md-8 custom-file">
                            <input id="imagen" type="file" class="custom-file-input" name="foto" required>
                            <label class="custom-file-label text-truncate" data-browse="Elegir" for="customFile">Seleccionar archivo</label>
                        </div>  
                    </div>  
                    </div>  
                <div class="modal-footer">
                    <button  class="btn btn-secondary btn-sm">Cambiar foto</button>
                    <button class="btn btn-sm btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal cambiar contraseña-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                    <div class="modal-header custom-color">
                            <h5 class="modal-title" id="exampleModalLabel" style="color:white">Cambio de Contraseña</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('users.updatecontrasena') }}" method="post">
                <div class="modal-body">
                    <!-- Aqui va el código de las contraseñar -->

                    
                    @csrf
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña Antigua') }}</label>

                            <div class="col-md-6 inputWithIcon">
                                <input id="old_password" type="password" placeholder="••••••••••••••" class="custom-ajusteTextoImagen form-control" name="old_password" >
                                <i class="fa fa-key fa-lg" aria-hidden="true"></i>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña Nueva') }}</label>

                            <div class="col-md-6 inputWithIcon">
                                <input id="password" type="password" placeholder="••••••••••••••" class="custom-ajusteTextoImagen form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <i id="show_password" class="fa fa-eye-slash fa-lg icon"  onclick="mostrarPassword()"></i>


                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar nueva Contraseña') }}</label>
                            
                            <div class="col-md-6 inputWithIcon">
                                <input id="password-confirm" type="password" placeholder="••••••••••••••" class="custom-ajusteTextoImagen form-control" name="password_confirmation" required autocomplete="new-password">
                                <i class="fa fa-lock fa-lg" aria-hidden="true"></i>
                            </div>
                        </div>
                
                </div>

                <div class="modal-footer">
                    
                    <button class="btn btn-secondary btn-sm">Guardar Cambios</button>
                    </form>
                    <button class="btn btn-sm btn-info" data-dismiss="modal">Cerrar</button>
                </div>
             
        </div>
    </div>
</div>



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

<!-- Script foto -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
        $(document).ready(function(){
            $('.custom-file-input').on('change', function() { 
            let fileName = $(this).val().split('\\').pop(); 
            $(this).next('.custom-file-label').addClass("selected").html(fileName); 
            });
        });    
</script>

<script>
     
    $( document ).ready(function() {
        $('.modal').on('show.bs.modal', function(){
            $(this).find('form')[0].reset();
        });
    });
</script>
@endsection
