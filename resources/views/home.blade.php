@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card margen-card custom-card">
            <!-- {{ Breadcrumbs::render('home') }}   -->   
                <div class="card-header custom-recuperarSesion custom-header">Carreras
                @role('admin')
                    <a href="#"  data-toggle="modal" data-target="#modal_crear"
                        class="btn btn-sm btn-secondary float-right" > 
                        <i class="fas fa-plus"></i> Crear Carrera
                    </a>    
                @endrole
                
                </div>
                        
                    <div class="card-body">
                        <div class="row">
                                @foreach($carreras as $carrera)
                                <div class="col-sm-4">
                                    <div class="card shadow p-3 " style="margin-bottom: 10px; border-radius: 25px; background-color: #474747" >
                                        <img class="card-img-top" src="../images/{{$carrera->imagen}}" alt="No image">
                                        @role('secretaria')
                                        <div class="text-center" >
                                            <a href=""  data-toggle="modal" data-target="#modal_crear_profesor"
                                            class="btn btn-sm btn-secondary float-cente" onClick="selCarrera('{{$carrera->id}}')" > 
                                            <i class="fas fa-plus"></i> Añadir Profesor </a>
                                            </div>
                                        @endrole
                                        <div class="text-center"style="margin-top:8px"> <a href="{{route('estudiantes.index',$carrera->id)}}" class="btn btn-sm btn-info"> Ver más</a></div>    
                                        

                                    </div>

                                </div>
                                @endforeach      
                        </div>
                    </div>
                    
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear una carrera -->
<div class="modal fade" id="modal_crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header custom-header custom-color">
        <h5 class="modal-title" id="exampleModalLabel" >Creación Carrera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('carrera.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Carrera') }}</label>
                
            <div class="col-md-6 inputWithIcon">
                <input id="nombre" type="text" class="custom-ajusteTextoImagen form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('name') }}" required autocomplete="name" autofocus>
                <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div> 
        
        <div class="form-group row">
            <label for="codigo_carrera" class="col-md-4 col-form-label text-md-right">{{ __('Codigo Carrera') }}</label>
                
            <div class="col-md-6 inputWithIcon">
                <input id="codigo_carrera" type="text" class="custom-ajusteTextoImagen form-control @error('codigo_carrera') is-invalid @enderror" name="codigo_carrera"  required autocomplete="codigo_carrera" autofocus>
                <i class="fa fa-hashtag fa-lg" aria-hidden="true"></i>
                @error('codigo_carrera')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>  

        <div class="form-group row">
            <label for="foto" class="col-md-4 col-form-label text-md-right fileinput">{{ __('Imagen Carrera') }}</label>
            <div class="col-md-6 custom-file">
                <input id="foto" type="file" class="custom-file-input" name="foto" >
                <label class="custom-file-label text-truncate" data-browse="Elegir" for="customFile">Seleccionar archivo</label>
            </div>  
        </div>

        <div class="modal-footer">  
                <button style="background-color: #2a9d8f; color:white"class="btn btn-info  btn-sm">Confirmar</button>
        </form>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal para crear usuario -->
<div class="modal fade" id="modal_crear_profesor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header custom-header">
        <h5 class="modal-title" id="exampleModalLabel" >Creación Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('users.store_profesor') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                <div class="col-md-6 inputWithIcon">
                    <input id="nombre" type="text" placeholder="Ejemplo: Juan" class="custom-ajusteTextoImagen form-control @error('name') is-invalid @enderror" name="nombre" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <i class="fa fa-user fa-lg" aria-hidden="true"></i>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>     


            <input type="hidden" id="id_rol" name="id_rol" value="2">

            
            <input type="hidden" id="carreras" name="carreras[]" value="">
           
            <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                    <div class="col-md-6 inputWithIcon">
                        <input id="email" type="email" placeholder="ejemplo@utalca.cl" class="custom-ajusteTextoImagen form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            </div>  

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                <div class="col-md-6 inputWithIcon">
                    <input id="password" type="password" placeholder="••••••••••••••" class="custom-ajusteTextoImagen form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <i id="show_password" class="fa fa-eye-slash fa-lg icon" onclick="mostrarPassword()"></i>

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

            <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                    <div class="col-md-6 inputWithIcon">
                        <input id="password-confirm" type="password" placeholder="••••••••••••••" class="custom-ajusteTextoImagen form-control" name="password_confirmation" required autocomplete="new-password">
                        <i class="fa fa-key fa-lg" aria-hidden="true"></i>
                    </div>
            </div>
            
            
            <div class="form-group row">
                <label for="foto" class="col-md-4 col-form-label text-md-right fileinput">{{ __('Foto') }}</label>
                <div class="col-md-6 custom-file">
                    <input id="imagen" type="file" class="custom-file-input" name="foto">
                    <label class="custom-file-label text-truncate" data-browse="Elegir" for="customFile">Seleccionar archivo</label>
                </div>  
            </div>                    

        </div>
        <div class="modal-footer">  
                
                <button class="btn btn-secondary  btn-sm">Confirmar</button>
        </form>

            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
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

    selCarrera = function(idCarrera){
        $('#carreras').val(idCarrera);
    };

</script>
@endsection
