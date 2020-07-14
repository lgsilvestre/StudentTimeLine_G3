
@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:30px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            {{ Breadcrumbs::render('estudiante', $estudiante) }}
                <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class= "custom-foto float-center"></div> 
                                <div class="form-group" >
                                    <ul>
                                        <a class="custom-negrita">Nombre: </a>
                                        {{$estudiante->nombre}} {{$estudiante->ap_Paterno}} {{$estudiante->ap_Materno}}
                                    </ul>
                                    <ul>
                                        <a class="custom-negrita">Rut: </a>
                                        {{$estudiante->rut}} 
                                    </ul>
                                    <ul>
                                        <a class="custom-negrita">Correo: </a>
                                        {{$estudiante->correo}} 
                                    </ul>
                                    <ul>
                                        <a class="custom-negrita">Matricula: </a>
                                        {{$estudiante->matricula}}
                                    </ul>
                                    <ul>
                                        <a class="custom-negrita">Situacion Academica: </a>
                                        {{$estudiante->estado_actual}} 
                                    </ul>
                                    <div >
                                        <button type="button" class="btn btn-primary" style="margin-left:40px" data-toggle="modal" data-target="#modalObservacion">
                                            {{ __('Agregar observacion') }}
                                        </button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-link custom-olvido" style="margin-top:10px;margin-left:40px" data-toggle="modal" data-target="#modalEditar">
                                            {{ __('Editar datos version 1') }}
                                        </button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-link custom-olvido" style="margin-top:10px;margin-left:40px" data-toggle="modal" data-target="#modal_editar">
                                            {{ __('Editar datos version 2') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 overflow-auto" style="height:470px">
                            <!-- Inicio linea de tiempo -->
                                
                                @if($observaciones->isempty())
                                    <ul >
                                        <li> 
                                            <h2>Sin observación</h2>
                                                <p>Hasta el momento, {{$estudiante->nombre}} {{$estudiante->ap_Paterno}} {{$estudiante->ap_Materno}} 
                                                no presenta observaciones en ningún módulo</p>
                                        </li>
                                    </ul>
                                @else
                                    <ul class="cbp_tmtimeline">
                                        @foreach($observaciones as $observacion)
                                        <li>
                                            <time class="cbp_tmtime" ><span>{{$observacion->created_at->format('d/m/y')}}</span> <span>{{$observacion->created_at->format('G:i A')}}</span></time>
                                            <div class="cbp_tmicon custom-tipo" tipo="{{$observacion->tipo_observacion}}" >
                                                @if($observacion->tipo_observacion=='Informativa')
                                                    <i class="fas fa-info-circle" ></i>
                                                @elseif($observacion->tipo_observacion=='Positiva')
                                                    <i class="fas fa-check-circle"></i>
                                                @else
                                                    <i class="fas fa-times-circle"></i>
                                                @endif

                                            </div>
                                            <div class="cbp_tmlabel">
                                                    <h2>Titulo: {{$observacion->titulo}}</h2>
                                                    <p>Autor: {{$observacion->nombre_autor}}</p>
                                                    <h6>Modulo: {{$observacion->modulo}}</h6>
                                                    <p>Detalle: {{$observacion->descripcion}}</p>
                                                    <footer>
                                                        <h6>Categoría: {{$observacion->nombre_categoria}}</h6>
                                                        <h6>Tipo: {{$observacion->tipo_observacion}}</h6>
                                                    </footer>
                                                    <!--SI EL TIEMPO DESDE QUE SE CREO ES MENOR A 24 HORAS-->
                                                    <button type="button" class="btn btn-editar custom-olvido" style="color: #ffffff; backgroundcolor: #05668B" data-toggle="modal" data-target="#modal_editarObservacion">
                                                    {{ __('Editar observacion') }}
                                                </button>
                                            </div>

                                        

                                        </li>
                                        @endforeach
                                        
                                    </ul>
                                @endif
                                
                                <!-- Fin linea de tiempo --> 
                            </div>
                        </div>  
                </div>  
            </div>
        </div>
    </div>
</div>  

<!-- Modal agregar observacion -->
<div class="modal fade" id="modalObservacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header custom-color">
                <h5 class="modal-title" id="modalProfileLabel" style="color:white">Observación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('observacion.store', $estudiante->id) }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <label id="titulo" class="col-md-2 col-form-label"> Título: </label>
                        <input type="text" name="titulo" id="titulo" class="col-md-8" placeholder="Ingrese un título" style="margin-left: 15px">    

                        <!--solo para llenar el campo, es momentaneo-->
                        <label for="tipo_observacion" class="col-md-2 col-form-label" style="margin-top: 10px">{{ __('Tipo:') }}</label>
                        <div class="col-md-9" style="margin-top: 10px">
                            <select for="tipo_observacion" name="tipo_observacion" class="form-control">
                                    <option value="Positiva">Positiva</option>
                                    <option value="Negativa">Negativa</option>
                                    <option value="Informativa">Informativa</option>
                            </select>
                        </div>
                        <!--fin del solo para llenar el campo-->

                        <label for="name" class="col-md-2 col-form-label" style="margin-top: 10px">{{ __('Categoría:') }}</label>
                        <div class="col-md-9" style="margin-top: 10px">
                            <select for="id_categoria" name="id_categoria" id="id_categoria" class="form-control">
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                      
                        <label for="name" class="col-md-2 col-form-label" style="margin-top: 10px">{{ __('Módulo:') }}</label>
                        <div class="col-md-9" style="margin-top: 10px">
                            <select for="modulo" name="modulo" class="form-control" id="modulo">
                            @foreach ($modulos as $modulo)
                                <option value="{{$modulo->descripcion}}">{{$modulo->descripcion}}</option>
                            @endforeach
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">{{ __('Observación:') }}</label>
                        <div class="col-md-6">
                            <textarea for="descripcion" id="descripcion" name="descripcion" rows="3" cols="35" style="resize: none"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                    
                        <label for="name" class="col-md-2 col-form-label"> Autor:</label>
                        <div class="col-md-4">
                            <label for="name" class="col-md-2 col-form-label"> {{$usuario->name}}</label>
                        </div>
                    </div>
                    <div class="form-grou row">
                        <label for="name" class="col-md-2 col-form-label"> Fecha:</label>
                        <div class="col-md-4">
                            <label for="name" style="margin-top:7px"> {{$now->format('d-m-Y')}}</label>
                        </div>
                    </div>
                    
                <div class="modal-footer">
                    <button  class="btn btn-secondary btn-sm">Agregar Observación</button>
                    <button class="btn btn-sm btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar observacion -->
<div class="modal fade" id="modal_editarObservacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header custom-color">
                <h5 class="modal-title" id="modalProfileLabel" style="color:white">Editar observación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('observacion.store', $estudiante->id) }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <label id="titulo" class="col-md-2 col-form-label"> Título: </label>
                        <input type="text" name="titulo" id="titulo" class="col-md-8" placeholder="Ingrese un título" style="margin-left: 15px">    

                        <!--solo para llenar el campo, es momentaneo-->
                        <label for="tipo_observacion" class="col-md-2 col-form-label" style="margin-top: 10px">{{ __('Tipo:') }}</label>
                        <div class="col-md-9" style="margin-top: 10px">
                            <select for="tipo_observacion" name="tipo_observacion" class="form-control">
                                    <option value="Positiva">Positiva</option>
                                    <option value="Negativa">Negativa</option>
                                    <option value="Informativa">Informativa</option>
                            </select>
                        </div>
                        <!--fin del solo para llenar el campo-->

                        <label for="name" class="col-md-2 col-form-label" style="margin-top: 10px">{{ __('Categoría:') }}</label>
                        <div class="col-md-9" style="margin-top: 10px">
                            <select for="id_categoria" name="id_categoria" id="id_categoria" class="form-control">
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                      
                        <label for="name" class="col-md-2 col-form-label" style="margin-top: 10px">{{ __('Módulo:') }}</label>
                        <div class="col-md-9" style="margin-top: 10px">
                            <select for="modulo" name="modulo" class="form-control" id="modulo">
                            @foreach ($modulos as $modulo)
                                <option value="{{$modulo->descripcion}}">{{$modulo->descripcion}}</option>
                            @endforeach
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">{{ __('Observación:') }}</label>
                        <div class="col-md-6">
                            <textarea for="descripcion" id="descripcion" name="descripcion" rows="3" cols="35" style="resize: none"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                    
                        <label for="name" class="col-md-2 col-form-label"> Autor:</label>
                        <div class="col-md-4">
                            <label for="name" class="col-md-2 col-form-label"> {{$usuario->name}}</label>
                        </div>
                    </div>
                    <div class="form-grou row">
                        <label for="name" class="col-md-2 col-form-label"> Fecha:</label>
                        <div class="col-md-4">
                            <label for="name" class="col-md-2 col-form-label"> {{$now->format('d-m-Y')}}</label>
                        </div>
                    </div>
                    
                <div class="modal-footer">
                    <button  class="btn btn-secondary btn-sm">Guardar Cambios</button>
                    <button class="btn btn-sm btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar datos estudiante-->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header custom-color">
                <h5 class="modal-title" id="modalProfileLabel" style="color:white">Datos estudiante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('estudiante.store', $estudiante->id) }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">

                    <div class="form-group row">
                        <label id="nombre" class="col-md-4 col-form-label text-md-left">{{ __('Nombre:') }} </label>
                        <div  class="col-md-6">
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder={{$estudiante->nombre}}>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label id="ap_Paterno" class="col-md-4 col-form-label text-md-left" > {{ __('Apellido Paterno:') }} </label>
                        <div  class="col-md-6">
                            <input type="text" class="form-control" name="ap_Paterno" id="ap_Paterno" placeholder={{$estudiante->ap_Paterno}}>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label id="ap_Materno" class="col-md-4" > {{ __('Apellido Materno:') }} </label>
                        <div  class="col-md-6">
                            <input type="text" class="form-control" name="ap_Materno" id="ap_Materno" placeholder={{$estudiante->ap_Materno}}>
                        </div>  
                    </div>  

                    <div class="form-group row">
                        <label id="ap_Materno" class="col-md-4" > {{ __('Rut:') }} </label>
                        <div  class="col-md-6">
                            <input type="text" class="form-control" name="ap_Materno" id="ap_Materno" placeholder={{$estudiante->rut}}>
                        </div>  
                    </div>  

                    <div class="form-group row">
                        <label id="ap_Materno" class="col-md-4" > {{ __('Matricula:') }} </label>
                        <div  class="col-md-6">
                            <input type="text" class="form-control" name="ap_Materno" id="ap_Materno" placeholder={{$estudiante->matricula}}>
                        </div>  
                    </div> 
                      
                    <div class="form-group row">
                        <label id="ap_Materno" class="col-md-4" > {{ __('Correo:') }} </label>
                        <div  class="col-md-6">
                            <input type="text" class="form-control" name="ap_Materno" id="ap_Materno" placeholder={{$estudiante->correo}}>
                        </div>  
                    </div>
                 
                    <div class="form-group row">
                        <label id="ap_Materno" class="col-md-4" > {{ __('Comuna:') }} </label>
                        <div  class="col-md-6">
                            <input type="text" class="form-control"  name="ap_Materno" id="ap_Materno" placeholder={{$estudiante->comuna}}>
                        </div>  
                    </div>
                 
                    <div class="form-group row">
                        <label id="ap_Materno" class="col-md-4" > {{ __('Región:') }} </label>
                        <div  class="col-md-6">
                            <input type="text" class="form-control"  name="ap_Materno" id="ap_Materno"  placeholder={{$estudiante->region}}>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label id="ap_Materno" class="col-md-4" > {{ __('Plan:') }} </label>
                        <div  class="col-md-6">
                            <input type="text" class="form-control" name="ap_Materno" id="ap_Materno"  placeholder={{$estudiante->plan}}>
                        </div>  
                    </div>
                 
                    <div class="form-group row">
                        <label for="situacion-academica" class="col-md-4">{{ __('Situación Academica:') }}</label>
                        <div class="col-md-6">
                            <select for="tipo_situacion" name="tipo_situacion" class="form-control">
                                    <option value="Regular">Regular</option>
                                    <option value="Irregular">Irregular</option>
                            </select>
                        </div>
                    </div>                 
                <div class="modal-footer">
                    <button  class="btn btn-secondary btn-sm">Guardar Cambios</button>
                    <button class="btn btn-sm btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<!--Modal editar datos estudiantes version 2-->
<div class="modal fade " id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header custom-header custom-color">
        <h5 class="modal-title" id="exampleModalLabel" >Editar Datos</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="{{ route('estudiante.store',$estudiante->id) }}" method="post">
                @csrf
        <div class="modal-body">
        <div class="col-xl-12 mx-auto">
            
                <div class="form-group row">
                    <div class="col-sm-3">
                        
                        <label for="inputFirstname">Matrícula</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="matricula" name="matricula" placeholder={{$estudiante->matricula}}>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputLastname">Rut</label>
                        <div class="form-group icono-input">
                            <span class="far fa-id-card fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="rut"name="rut" placeholder={{$estudiante->rut}}>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="inputLastname">Correo Electrónico</label>
                        <div class="form-group icono-input">
                            <span class="far fa-envelope fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="correo" name="correo" placeholder={{$estudiante->correo}}>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="inputAddressLine1">Nombres</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder={{$estudiante->nombre}}>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputAddressLine2">Ap. Paterno</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="ap_Paterno" name="ap_Paterno" placeholder={{$estudiante->ap_Paterno}}>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputAddressLine2">Ap. Materno</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="ap_Materno" name="ap_Materno" placeholder={{$estudiante->ap_Materno}}>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputCity">Situación Academica</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-graduation-cap fa-lg form-control-feedback" aria-hidden="true"></span>
                            <select class="form-control" id="estado_actual" name="estado_actual">
                                <option>Regular</option>
                                <option>No regular</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    
                    <div class="col-sm-3">
                        <label for="inputWebsite">Comuna</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-house-user fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="comuna" name="comuna" placeholder={{$estudiante->comuna}}>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <label for="inputWebsite">Región</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="number" class="form-control" min="1" id="region" name="region" placeholder={{$estudiante->region}}>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <label for="inputWebsite">Nivel</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="number" class="form-control" min="1" max="12" id="nivel" name="nivel" placeholder={{$estudiante->nivel}}>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputWebsite">Plan</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control"  id="plan" name="plan" placeholder={{$estudiante->plan}}>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">  
                
            <button style="background-color: #2a9d8f; color:white"class="btn btn-info  btn-sm">Guardar Cambios</button>
        </form>

            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

@endsection
