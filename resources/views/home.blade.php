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
                        class="btn btn-sm btn-secondary float-right" style="background-color: #2a9d8f"> 
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
                                        <div class="text-center"> <a href="{{route('estudiantes.index',$carrera->id)}}" class="btn btn-info"> Ver más</a></div>       
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
                <input id="foto" type="file" class="custom-file-input" name="foto">
                <label class="custom-file-label text-truncate" for="customFile">Seleccionar archivo</label>
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



@endsection
