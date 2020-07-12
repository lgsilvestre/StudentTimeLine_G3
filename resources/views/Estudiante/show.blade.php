
@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:30px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            {{ Breadcrumbs::render('estudiante', $estudiante) }}
                <div class="card-body custom-lineaTiempo">
                    <div class= "custom-foto float-center"></div> 
                    <div class="form-group" style="margin-top:25px; width: 400px;">
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
                                {{ __('Editar datos') }}
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Inicio linea de tiempo -->
                <div class="card-body overflow-auto custom-lineaTiempo" style="width:739px;margin-left:370px;margin-top:-490px">
                @if($observaciones->isempty())
                <ul class="cbp_tmtimeline">
                        <li> 
                            <time class="cbp_tmtime"><span>{{$now->format('d/m/y')}}</span> <span>{{$now->format('G:i A')}}</span></time>
                            <div class="cbp_tmicon "><i class="fas fa-info-circle"></i></div>
                            <div class="cbp_tmlabel">
                                <h2>Sin observación</h2>
                                <p>Hasta el momento, {{$estudiante->nombre}} {{$estudiante->ap_Paterno}} {{$estudiante->ap_Materno}} 
                                no presenta observaciones en ningún módulo</p>
                            </div>
                        </li>
                    </ul>
                @else
                    <ul class="cbp_tmtimeline">
                        @foreach($observaciones as $observacion)
                        <li>
                            <time class="cbp_tmtime" ><span>{{$observacion->created_at->format('d/m/y')}}</span> <span>{{$observacion->created_at->format('G:i A')}}</span></time>
                            <div class="cbp_tmicon "><i class="fas fa-info-circle" ></i></div>
                            <div class="cbp_tmlabel">
                                <h2>Titulo: {{$observacion->titulo}}</h2>
                                <p>Autor: {{$observacion->nombre_autor}}</p>
                                <h6>Modulo: {{$observacion->modulo}}</h6>
                                <p>Detalle: {{$observacion->descripcion}}</p>
                                <footer>
                                    <h6>Categoría: {{$observacion->nombre_categoria}}</h6>
                                    <h6>Tipo: {{$observacion->tipo_observacion}}</h6>
                                </footer>
                            </div>
                        @endforeach
                        </li>
                    </ul>
                @endif
                <!-- Fin linea de tiempo -->
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
                    <button  class="btn btn-secondary btn-sm">Agregar Observación</button>
                    <button class="btn btn-sm btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal agregar observacion -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <button  class="btn btn-secondary btn-sm">Agregar Observación</button>
                    <button class="btn btn-sm btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>


@endsection
