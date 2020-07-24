
@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:30px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card custom-card">
            {{ Breadcrumbs::render('estudiante', $estudiante) }}
                <div class="card-body " >
                        <div class="row">
                            <div class="col-sm-4">
                                <div class= "custom-foto float-center"></div> 
                                <div class="form-group" >

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
                                        <button type="button" class="btn btn-sm btn-info"  data-toggle="modal" data-target="#modal_editar">
                                        <i class="fas fa-pencil-alt"></i> {{ __('Editar datos') }}
                                        </button>
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
                                            
                                            <button class="btn btn-sm" data-toggle="modal" id="boton-editarobservacion" onclick="editar_observacion('{{$observacion->titulo}}','{{$observacion->nombre_autor}}','{{$observacion->modulo}}','{{$observacion->descripcion}}','{{$observacion->nombre_categoria}}','{{$observacion->tipo_observacion}}','{{$observacion->id}}','{{$observacion->semestre}}')"><i class="fas fa-edit fa-lg" style="font-size:20px;color: #20c997;"></i></button>
                                            <button class="btn btn-sm"><i class="fas fa-times-circle " style="margin-top:4px;font-size:20px;margin-left:0px;color: #ff6b6b;" onclick="eliminar_observacion('{{$observacion->id}}')"></i></button>
                                            <span class="cd-date"><i class="fas fa-clock"></i><strong> {{$observacion->created_at->locale('es')->isoFormat('dddd D, MMMM YYYY')}}</strong></span>
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
                    <div class="form-group row">
                    
                        <label for="name" class="col-md-2 col-form-label"> Semestre:</label>
                        <div class="col-md-6">
                       
                            @if($now->format('m')>= '04' && $now->format('m')<= '08' )
                                <label for="semestre_agregar" class="col-form-label">Otoño-Invierno (1) {{$now->format('Y')}}</label>               
                            @elseif($now->format('m')>= '09' && $now->format('m')<= '12')
                                <label for="semestre_agregar" class="col-form-label">Primavera-Verano (2) {{$now->format('Y')}}</label>        
                            @elseif($now->format('m')>= '01' && $now->format('m')<= '03')
                                <label for="semestre_agregar" class="col-form-label">Primavera-Verano (2) {{$now->format('Y')-1}}</label>
                            @endif
                        
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
                            <select for="editar_semestre" name="semester_edit" class="form-control">
                                <option value="Otoño-Invierno (1)">Otoño-Invierno (1)</option>
                                <option value="Primavera-Verano (2)">Primavera-Verano (2)</option>
                            </select>
                        </div>

                    <label for="tipo_observacion" class="col-md-1 col-form-label" style="margin-top: 10px">{{ __('Año:') }}</label>
                        <div class="col-md-3" style="margin-top: 10px">
                            <select name="anio" id="anio_semestre" class="form-control">
                                @for($i= 1955; $i <= $now->format('Y') ; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    @else
                        <label for="name" class="col-md-2 col-form-label"> Semestre:</label>
                        <div class="col-md-6">
                                <label for="editar_semestre" id="semestre_editar" name="semestre_edit" class="col-form-label">{{$observacion->semestre}}</label>               
                        </div>
                    @endrole
                    </div>

                    <div class="form-grou row">
                        <label for="name" class="col-md-2 col-form-label"> Fecha:</label>
                        <div class="col-md-4">
                            <label for="name" name="fecha_edit" style="margin-top:7px">{{$now->format('d/m/Y')}}</label>
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
        <form action="{{ route('estudiante.update',$estudiante->id) }}" method="post">
                @csrf
        <div class="modal-body">
        <div class="col-xl-12 mx-auto">
            
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
        $('#semestre_editar').val(semestre);
        $('#modal_editarObservacion').modal('show');
    }
</script>

<script>
    function eliminar_observacion(id){
        $('#id_eliminar_observacion').val(id);
        $('#modal_eliminarObservacion').modal('show');
    }
</script>
@endsection
