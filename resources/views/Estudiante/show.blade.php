@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card custom-card margen-card" >
            {{ Breadcrumbs::render('estudiante', $estudiante) }}
                <div class="card-body " >
                        <div class="row">
                            <div class="col-sm-4">
                                <div class= "float-center">
                                    @if($estudiante->sexo == 'f')
                                        <img class="imagen custom-fotoalumno" src="../images/alumna.png" alt="">
                                    @else
                                        <img class="imagen custom-fotoalumno" src="../images/alumno.png" alt="">
                                    @endif
                                </div>
                                <div class="form-group">

                                    <table class="table table-striped table-bordered table-striped shadow p-3 mb-4">
                                        <tbody>
                                        <tr >
                                            <td> <a class="custom-negrita">Nombre: </a>{{$estudiante->nombre}} {{$estudiante->ap_Paterno}} {{$estudiante->ap_Materno}}</td>
                                        </tr>
                                        <tr>   
                                            <td><a class="custom-negrita">Rut: </a>{{$estudiante->rut}}  </td>
                                        
                                        <tr>
                                            <td><a class="custom-negrita">Correo: </a>{{$estudiante->correo}} </td>
                                        </tr>
                                        <tr>
                                            <td><a class="custom-negrita">Matricula: </a>{{$estudiante->matricula}}</td>
                                        </tr>
                                        <tr>
                                            <td><a class="custom-negrita">Situacion Academica: </a>{{$estudiante->estado_actual}} </td>
                                        </tr>
                                                
                                        </tbody>
                                    </table>
                                    <div style="margin-right:auto">
                                        @can('estudiante.add')
                                            <button type="button" class="btn btn-sm btn-info" onClick="validar();" data-toggle="modal" data-target="#modal_editar_wizard">
                                            <i class="fas fa-pencil-alt"></i> {{ __('Editar datos') }}
                                            </button>
                                        @endcan
                                        <button type="button" class="btn btn-sm btn-secondary" style="margin-left:6px" data-toggle="modal" data-target="#modalObservacion">
                                        <i class="fas fa-plus"></i> {{ __('Agregar observacion') }}
                                        </button>
                                        
                                    </div>
                                    <div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 overflow-auto " style="height:470px; border-radius: 12px;" >
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
                                <section id="cd-timeline" class="cd-container">
                                    @foreach($observaciones as $observacion)
                                    <div class="cd-timeline-block">
                                        <div class="cd-timeline-img custom-tipo cd-picture" tipo="{{$observacion->tipo_observacion}}">
                                        @if($observacion->tipo_observacion=='Informativa')
                                            <i class="fas fa-info-circle fa-lg"  style="margin-left:5.5px;margin-top:7.5px"></i>
                                        @elseif($observacion->tipo_observacion=='Positiva')
                                            <i class="fas fa-check-circle fa-lg"  style="margin-left:5.5px;margin-top:7.4px"></i>
                                        @else
                                            <i class="fas fa-times-circle fa-lg" style="margin-left:5.5px;margin-top:8px"></i>
                                        @endif
                                        </div><!-- cd-timeline-img -->

                                        <div class="cd-timeline-content">
                                            <h2><strong>{{$observacion->titulo}}</strong></h2>
                                            <div class="timeline-content-info">
                                                <span class="timeline-content-info-title">
                                                    <i class="fa fa-certificate" aria-hidden="true"></i>
                                                    Autor: {{$observacion->nombre_autor}}
                                                </span>
                                                
                                            </div>
                                            <p>{{$observacion->descripcion}}</p>
                                            <ul class="content-skills">
                                            <li><i class="fas fa-info-circle"></i> Categoria: {{$observacion->nombre_categoria}}</li>
                                            <li><i class="fas fa-info-circle"></i> Modulo: {{$observacion->modulo}}</li>
                                            <li><i class="fas fa-info-circle"></i> Semestre: {{$observacion->semestre}}</li>
                                            
                                            </ul>
                                            @role('admin') 
                                                <button class="btn btn-sm" data-toggle="modal" id="boton-editarobservacion" onclick="editar_observacion('{{$observacion->titulo}}','{{$observacion->nombre_autor}}','{{$observacion->modulo}}','{{$observacion->descripcion}}','{{$observacion->nombre_categoria}}','{{$observacion->tipo_observacion}}','{{$observacion->id}}','{{$observacion->semestre}}')"><i class="fas fa-edit fa-lg" style="font-size:20px;color: #20c997;"></i></button>
                                                <button class="btn btn-sm"><i class="fas fa-times-circle " style="margin-top:4px;font-size:20px;margin-left:0px;color: #ff6b6b;" onclick="eliminar_observacion('{{$observacion->id}}')"></i></button>
                                            @else
                                                @if($observacion->created_at <= $now && $now <= $observacion->fecha_limite)
                                                    @if($usuario->id == $observacion->id_autor)
                                                        <button class="btn btn-sm" data-toggle="modal" id="boton-editarobservacion" onclick="editar_observacion('{{$observacion->titulo}}','{{$observacion->nombre_autor}}','{{$observacion->modulo}}','{{$observacion->descripcion}}','{{$observacion->nombre_categoria}}','{{$observacion->tipo_observacion}}','{{$observacion->id}}','{{$observacion->semestre}}')"><i class="fas fa-edit fa-lg" style="font-size:20px;color: #20c997;"></i></button>
                                                        <button class="btn btn-sm"><i class="fas fa-times-circle " style="margin-top:4px;font-size:20px;margin-left:0px;color: #ff6b6b;" onclick="eliminar_observacion('{{$observacion->id}}')"></i></button>
                                                    @endif
                                                @endif
                                            @endrole
                                            <span class="cd-date"><i class="fas fa-clock"></i><strong> {{$observacion->created_at->locale('es')->isoFormat('ddd D MMMM YYYY')}}</strong></span>
                                        </div> <!-- cd-timeline-content -->
                                    </div> <!-- cd-timeline-block -->
                                    @endforeach
                                </section> <!-- cd-timeline -->
                                @endif                               
                                <!-- Fin linea de tiempo --> 
                            </div>
                        </div>  
                </div>  
            </div>
        </div>
    </div>
</div>  
<div class="modal fade" id="modal_editarObservacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header custom-color">
                <h5 class="modal-title" id="modalProfileLabel" style="color:white">Editar Observación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('observacion.update', $estudiante->id) }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <!--id llamado para editar-->
                        <input type="hidden" name="id_edit" id="id_editar" value="" class="col-md-8">  
                        <!--fin de llamado al id-->

                        <label id="titulo" class="col-md-2 col-form-label"> Título: </label>
                        <input type="text" name="titulo_edit" id="titulo_editar" class="col-md-8" style="margin-left: 15px">    

                        <!--solo para llenar el campo, es momentaneo-->
                        <label for="tipo_observacion" class="col-md-2 col-form-label" style="margin-top: 10px">{{ __('Tipo:') }}</label>
                        <div class="col-md-9" style="margin-top: 10px">
                            <select for="tipo_observacion" name="tipo_edit" id="tipo_editar" name="tipo_observacion" class="form-control">
                                    <option value="Positiva">Positiva</option>
                                    <option value="Negativa">Negativa</option>
                                    <option value="Informativa">Informativa</option>
                            </select>
                        </div>
                        <!--fin del solo para llenar el campo-->

                        <label for="name" class="col-md-2 col-form-label" style="margin-top: 10px">{{ __('Categoría:') }}</label>
                        <div class="col-md-9" style="margin-top: 10px">
                            <select for="categoria" name="categoria_edit" id="categoria_editar" class="form-control">
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->nombre}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                      
                        <label for="name" class="col-md-2 col-form-label" style="margin-top: 10px">{{ __('Módulo:') }}</label>
                        <div class="col-md-9" style="margin-top: 10px">
                            <select for="modulo" name="modulo_edit" id="modulo_editar" class="form-control">
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
                            <textarea for="descripcion" name="descripcion_edit" id="descripcion_editar" rows="3" cols="35" style="resize: none"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                    
                        <label for="name" class="col-md-2 col-form-label"> Autor:</label>
                        <div class="col-md-4">
                            <label for="name" name="autor_edit" class="col-md-2 col-form-label">{{$usuario->name}}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                    
                    @role('admin')   
                    <label for="tipo_observacion" class="col-md-2 col-form-label" style="margin-top: 10px">{{ __('Semestre:') }}</label>
                        <div class="col-md-5" style="margin-top: 10px">
                            <select for="editar_semestre" name="semester_edit" id="semestre_editar" class="form-control">
                                <option value="Otoño-Invierno">Otoño-Invierno</option>
                                <option value="Primavera-Verano">Primavera-Verano</option>
                            </select>
                        </div>

                    <label for="tipo_observacion" class="col-md-1 col-form-label" style="margin-top: 10px">{{ __('Año:') }}</label>
                        <div class="col-md-3" style="margin-top: 10px">
                            <select name="año" id="año_editar" class="form-control">
                                @for($i= 1981; $i <= $now->format('Y') ; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div style="display: none" id="mostrar_semestre"></div>
                    @else
                        <label for="name" class="col-md-2 col-form-label"> Semestre:</label>
                        <div class="col-md-6">
                                <div for="editar_semestre" name="semestre_edit"  id="mostrar_semestre" class="col-form-label"></div>               
                        </div>
                    @endrole
                    </div>

                    <div class="form-grou row">
                        <label for="name" class="col-md-2 col-form-label"> Fecha:</label>
                        <div class="col-md-6">
                            <label for="name" name="fecha_edit" style="margin-top:7px">{{$now->locale('es')->isoFormat('dddd D, MMMM YYYY')}}</label>
                        </div>
                    </div>    
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-secondary btn-sm">Editar Observación</button>
                    <button class="btn btn-sm btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
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
                        <label for="name" class="col-md-2 col-form-label">{{ __('Detalle:') }}</label>
                        <div class="col-md-4">
                            <textarea for="descripcion" id="descripcion" name="descripcion" rows="3" cols="35" style="resize: none"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                    
                        <label for="name" class="col-md-2 col-form-label">Autor:</label>
                        <label for="name" class="col-md-2 col-form-label">{{$usuario->name}}</label>
                    </div>
                    <div class="form-group row">
                    
                        <label for="name" class="col-md-2 col-form-label"> Semestre:</label>
                        <div class="col-md-6">
                       
                            @if($now->format('m')>= '04' && $now->format('m')<= '08' )
                                <label for="semestre_agregar" class="col-form-label">Otoño-Invierno  {{$now->format('Y')}}/1</label>               
                            @elseif($now->format('m')>= '09' && $now->format('m')<= '12')
                                <label for="semestre_agregar" class="col-form-label">Primavera-Verano {{$now->format('Y')}}/2</label>        
                            @elseif($now->format('m')>= '01' && $now->format('m')<= '03')
                                <label for="semestre_agregar" class="col-form-label">Primavera-Verano {{$now->format('Y')-1}}/2(</label>
                            @endif
                        
                        </div>
                    </div>
                    <div class="form-grou row">
                        <label for="name" class="col-md-2 col-form-label"> Fecha:</label>
                        <div class="col-md-5">
                            <label for="name" style="margin-top:7px"> {{$now->locale('es')->isoFormat('dddd D, MMMM YYYY')}}</label>
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

<!--Modal WIZARD editar ESTUDIANTE-->
<div id="modal_editar_wizard" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header custom-header custom-color">
        <h5 class="modal-title" id="wizard-title">Editar estudiante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
    
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#infoPanel" role="tab" id="adsBack">Datos personales</a>
          <li>
          <li class="nav-item">
            <a class="nav-link disabled" data-toggle="tab" href="#ads" role="tab" id="infoContinue">Datos académicos</a>
          <li>
        </ul>


        <form action="{{ route('estudiante.update',$estudiante->id) }}" method="post">
            @csrf
        <div class="tab-content mt-2">
          <div class="tab-pane fade show active" id="infoPanel" role="tabpanel"  href="#infoPanel">
            <div class="form-group"> 
            
                <div class="col-xl-12 mx-auto">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="inputAddressLine1">Nombres</label>
                            <label style="color:red"> (*) </label> 
                                    <div class="form-group icono-input">
                                        <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                        <input type="text" class="form-control" id="nombre_wizard" oninput="validar();" name="nombre" value="{{$estudiante->nombre}}" required>
                                    </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="inputAddressLine2">Ap. Paterno</label>
                            <label style="color:red"> (*) </label> 
                                    <div class="form-group icono-input">
                                        <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                        <input type="text" class="form-control" id="ap_Paterno_wizard" oninput="validar();" name="ap_Paterno" value="{{$estudiante->ap_Paterno}}" required>
                                    </div>
                        
                        </div>

                        <div class="col-sm-4">
                            <label for="inputAddressLine2">Ap. Materno</label>
                            <label style="color:red"> (*) </label> 
                                    <div class="form-group icono-input">
                                        <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                        <input type="text" class="form-control" id="ap_Materno_wizard" oninput="validar();"  name="ap_Materno" value="{{$estudiante->ap_Materno}}" required>
                                    </div>
                        
                        </div>
  

                    </div>

                    <div class="form-group row">

                        <div class="col-sm-4">
                            <label for="inputLastname">Rut</label>
                            <label style="color:red"> (*) </label> 
                            <div class="form-group icono-input">
                                <span class="far fa-id-card fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control" id="rutificador_wizard" oninput="validar();" name="rut" value="{{$estudiante->rut}}" required>
                            </div>
                        </div>
                        <div class="col-sm-4 ">
                                <label for="inputState">Género</label>
                                <label style="color:red"> (*) </label> 
                                <div class="form-group icono-input">
                                    <span class="fas fa-venus-mars fa-lg form-control-feedback" aria-hidden="true"></span>
                                    <select class="form-control" id="sexo" name="sexo" required> 
                                        <option>Masculino</option>
                                        <option>Femenino</option>
                                        <option>Otro</option>
                                    </select>
                                </div>
                        </div>                  
                        <div class="col-sm-4">
                                <label for="inputContactNumber">Fecha de nacimiento</label>
                                <label style="color:red"> (*) </label> 
                                <div class="form-group icono-input">
                                    <span class="far fa-calendar-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                    <input type="date" class="form-control" oninput="validar();" id="fech_nac_wizard" name="fech_nac" value="{{$estudiante->fech_nac}}" required>
                                </div>
                        </div>

                    </div>



                    <div class="form-group row">

                        <div class="col-sm-5">
                                <label for="inputLastname">Correo Electrónico</label>
                                <label style="color:red"> (*) </label> 
                                <div class="form-group icono-input">
                                    <span class="far fa-envelope fa-lg form-control-feedback" aria-hidden="true"></span>
                                    <input type="text" class="form-control" oninput="validar();" id="correo_wizard" name="correo" value="{{$estudiante->correo}}" required>
                                </div>
                        </div>

                        <div class="col-sm-2">
                                <label for="inputWebsite">Región</label>
                                <div class="form-group icono-input">
                                    <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                    <input type="number" class="form-control" min="1" max="16" id="region" name="region" value="{{$estudiante->region}}">
                                </div>
                        </div>

                        <div class="col-sm-5">
                            <label for="inputWebsite">Comuna</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-house-user fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control" id="comuna" name="comuna" value="{{$estudiante->comuna}}">
                            </div>
                        </div>

                    </div>

                </div>
                <label style="color:red">(*)</label>
                <label>Campos obligatorios</label>
                <div class="float-right">
                    <button id="scheduleContinue" class="btn btn-secondary">Continuar</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal" >Cancelar</button>
                </div>
                <br></br>
            </div>
            
          </div>


          <div class="tab-pane fade" id="ads" role="tabpanel"  href="#ads">

            <div class="form-group">
               <div class="col-xl-12 mx-auto">

                    <div class="form-group row">

                        <div class="col-sm-3">
                            
                            <label for="inputFirstname">Matrícula</label>
                            <label style="color:red"> (*) </label> 
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control" id="matricula_wizard" name="matricula" value="{{$estudiante->matricula}}" required>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <label for="inputContactNumber">Año ingreso</label>
                            <label style="color:red"> (*) </label> 
                            <div class="form-group icono-input">
                                <span class="far fa-calendar-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="number" class="form-control" min="1981" id="ano_ingreso_wizard" name="ano_ingreso" value="{{$estudiante->año_ingreso}}" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                        <label for="inputCarrera">Carrera</label>
                        <label style="color:red"> (*) </label> 
                            <div class="form-group icono-input">
                            <span class="fas fa-graduation-cap fa-lg form-control-feedback" aria-hidden="true"></span>
                            <select class="form-control" id="carrera_wizard" name="carrera">
                                @foreach($carreras as $carrera)
                                    @if($estudiante->id_carrera==$carrera->id)
                                        <option value="{{$carrera->id}}" selected>{{$carrera->nombre}}</option>
                                    @else
                                        <option value="{{$carrera->id}}">{{$carrera->nombre}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                                <label for="inputContactNumber">Via ingreso</label>
                                <label style="color:red"> (*) </label> 
                                <div class="form-group icono-input">
                                    <span class="fas fa-graduation-cap fa-lg form-control-feedback" aria-hidden="true"></span>
                                        <select class="form-control" id="via_ingreso_wizard" name="via_ingreso">
                                            <option>Via PSU</option>
                                            <option>Alumnos Talentosos</option>
                                            <option>PACE</option>
                                            <option>Beca extranjero</option>
                                        </select>
                                </div>
                            </div>

                    </div>

                    <div class="form-group row">
                        
                        <div class="col-sm-3">
                                <label for="inputCity">Situación Academica</label>
                                <label style="color:red"> (*) </label> 
                                <div class="form-group icono-input">
                                    <span class="fas fa-graduation-cap fa-lg form-control-feedback" aria-hidden="true"></span>
                                    <select class="form-control" id="estado_actual_wizard" name="estado_actual">
                                        <option>Regular</option>
                                        <option>No regular</option>
                                    </select>
                                </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="inputWebsite">Nivel</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="number" class="form-control" min="1" max="12" id="nivel" name="nivel" value="{{$estudiante->nivel}}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="inputWebsite">Plan</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control"  id="plan" name="plan" value="{{$estudiante->plan}}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="inputWebsite">Créditos Aprobados</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="number" class="form-control" min="0" max="400" id="creditos" name="creditos" value="{{$estudiante->creditos_aprobados}}">
                            </div>
                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-sm-3">
                            <label for="inputWebsite">Porcentaje Avance</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="number" class="form-control" min="0" max="100"id="porc_avance" name="porc_avance" value="{{$estudiante->porc_avance}}">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <label for="inputWebsite">Último puntaje prioridad</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control"  id="prioridad" name="prioridad" value="{{$estudiante->ult_ptje_prioridad}}">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <label for="inputWebsite">Promedio Aprobados</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control"  id="aprobados" name="aprobados" value="{{$estudiante->prom_aprobadas}}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="inputWebsite">Promedio Cursados</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control"  id="cursados" name="cursados" value="{{$estudiante->prom_cursados}}">
                            </div>
                        </div>
                    </div>
               </div>
               
            </div>
            <label style="color:red">(*)</label>
            <label>Campos obligatorios</label>
            <div class="float-right">
                <button  class="btn btn-secondary"  >Guardar</button>
                <button  type="button" class="btn btn-info" data-dismiss="modal" >Cancelar</button>
                </form>
            </div>
            <br></br>
           </div>
         </div>
            <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Paso 1 de 2</div>
            </div> 
        </div>
    </div>
  </div>
</div>

<!--FIN MODAL WIZARD EDITAR ESTUDIANTE-->
<!-- Modal editar observacion -->


<!-- Modal para eliminar observacion -->
<div class="modal fade" id="modal_eliminarObservacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header custom-colorAdvertencia">
        <h5 class="modal-title" id="exampleModalLabel" style="color:white">Advertencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Está seguro que desea eliminar la observación seleccionada?
      </div>
      <div class="modal-footer">  
            <form action="{{ route('observacion.destroy', $estudiante->id) }}" method="post">
            @csrf
                <input type="hidden" id="id_eliminar_observacion" name="id_observacion_eliminar" value="">
                <button class="btn btn-secondary btn-sm">Confirmar</button>
            </form>

            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--Modal editar datos estudiantes version 2
<div class="modal fade " id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header custom-header custom-color">
            <h5 class="modal-title" id="exampleModalLabel" >Editar Datos</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('estudiante.update',$estudiante->id) }}" method="post">
                @csrf
        <div class="modal-body">
        <div class="col-xl-11 mx-auto">
            
                <div class="form-group row">
                    <div class="col-sm-3">
                        
                        <label for="inputFirstname">Matrícula</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="matricula" name="matricula" value="{{$estudiante->matricula}}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputLastname">Rut</label>
                        <div class="form-group icono-input">
                            <span class="far fa-id-card fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="rut"name="rut" value="{{$estudiante->rut}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="inputLastname">Correo Electrónico</label>
                        <div class="form-group icono-input">
                            <span class="far fa-envelope fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="correo" name="correo" value="{{$estudiante->correo}}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="inputAddressLine1">Nombres</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{$estudiante->nombre}}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputAddressLine2">Ap. Paterno</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="ap_Paterno" name="ap_Paterno" value="{{$estudiante->ap_Paterno}}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputAddressLine2">Ap. Materno</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="ap_Materno" name="ap_Materno" value="{{$estudiante->ap_Materno}}">
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
                    <div class="col-sm-4">
                        <label for="inputCarrera">Carrera</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-graduation-cap fa-lg form-control-feedback" aria-hidden="true"></span>
                            <select class="form-control" id="carrera" name="carrera">
                            @foreach($carreras as $carrera)
                                @if($estudiante->id_carrera==$carrera->id)
                                    <option value="{{$carrera->id}}" selected>{{$carrera->nombre}}</option>
                                @else
                                    <option value="{{$carrera->id}}">{{$carrera->nombre}}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputWebsite">Comuna</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-house-user fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="comuna" name="comuna" value="{{$estudiante->comuna}}">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <label for="inputWebsite">Región</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="number" class="form-control" min="1" id="region" name="region" value="{{$estudiante->region}}">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <label for="inputWebsite">Nivel</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="number" class="form-control" min="1" max="12" id="nivel" name="nivel" value="{{$estudiante->nivel}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputWebsite">Plan</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control"  id="plan" name="plan" value="{{$estudiante->plan}}">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">  
                
            <button class="btn btn-secondary  btn-sm">Guardar Cambios</button>
        </form>

            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
-->

<script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  

<script>
    function editar_observacion(titulo, autor, modulo, descripcion, categoria, tipo, id, semestre){
        $('#titulo_editar').val(titulo);
        $('#autor_editar').val(autor);
        $('#categoria_editar').val(categoria);
        $('#modulo_editar').val(modulo);
        $('#descripcion_editar').val(descripcion);
        $('#tipo_editar').val(tipo);
        $('#id_editar').val(id);
        document.getElementById('mostrar_semestre').innerHTML = semestre;
        cadena = semestre.split(" ");
        cadena2 = cadena[1].split("/");
        console.log(cadena[0]);
        $('#semestre_editar').val(cadena[0]);
        $('#año_editar').val(cadena2[0]);
        $('#modal_editarObservacion').modal('show');
    }
</script>

<script>
    function eliminar_observacion(id){
        $('#id_eliminar_observacion').val(id);
        $('#modal_eliminarObservacion').modal('show');
    }
</script>

<script>
    $('#infoContinue').click(function (e) {
    e.preventDefault();
    $('.progress-bar').css('width', '100%');
    $('.progress-bar').html('Paso 2 de 2');
    $('#myTab a[href="#ads"]').tab('show');
  });

  $('#adsBack').click(function (e) {
    e.preventDefault();
    $('.progress-bar').css('width', '50%');
    $('.progress-bar').html('Paso 1 de 2');
    $('#myTab a[href="#infoPanel"]').tab('show');
  });


  $('#scheduleContinue').click(function (e) { 
    var nombre = $("input#nombre_wizard").val().length;
    var ap_paterno = $("input#ap_Paterno_wizard").val().length;
    var ap_materno = $("input#ap_Materno_wizard").val().length;
    var fecha = $("input#fech_nac_wizard").val().length;
    var correo = $("input#correo_wizard").val().length;
    var rut = $("#rutificador_wizard").val().length;  
    
    if (nombre != 0 && ap_paterno != 0 && ap_materno != 0 && correo != 0 && fecha != 0 && rut != 0) {
        e.preventDefault();
        $('.progress-bar').css('width', '100%');
        $('.progress-bar').html('Paso 2 de 2');
        $('#myTab a[href="#ads"]').tab('show');
    }  
  });
  function validar(){
    var nombre = $("input#nombre_wizard").val().length;
    var ap_paterno = $("input#ap_Paterno_wizard").val().length;
    var ap_materno = $("input#ap_Materno_wizard").val().length;
    var fecha = $("input#fech_nac_wizard").val().length;
    var correo = $("input#correo_wizard").val().length;
    var rut = $("#rutificador_wizard").val().length;  
            console.log("hola");
            if (nombre != 0 && ap_paterno != 0 && ap_materno != 0 && correo != 0 && fecha != 0 && rut != 0) {
                $( "#infoContinue" ).removeClass('disabled');
               
            }  else{
                $( "#infoContinue" ).addClass('disabled');
            }
};


</script>

@endsection