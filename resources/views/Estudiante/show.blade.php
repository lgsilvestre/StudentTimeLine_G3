
@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:40px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header custom-inicioSesion custom-color">{{ __('Línea de Tiempo') }}</div>
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
                <div class="card-body overflow-auto custom-lineaTiempo" style=" width:739px;margin-left:370px;margin-top:-480px">
                <ul class="cbp_tmtimeline">
                    <li>
                        <time class="cbp_tmtime"><span>4/10/13</span> <span>18:30</span></time>
                        <div class="cbp_tmicon cbp_tmicon-phone"></div>
                        <div class="cbp_tmlabel">
                            <h2>Observacion 1</h2>
                            <p>Phishing es un término informático que denomina a un conjunto de técnicas que persiguen el engaño a una víctima ganándose su confianza haciéndose pasar por una persona, empresa o servicio de confianza (suplantación de identidad de tercero de confianza), para manipularla y hacer que realice acciones que no debería realizar (por ejemplo revelar información confidencial o hacer click en un enlace).Para realizar el engaño, habitualmente hace uso de la ingeniería social explotando los instintos sociales de la gente, como es de ayudar o ser eficiente. A veces también se hace uso de procedimientos informáticos que aprovechan vulnerabilidades. Habitualmente el objetivo es robar información pero otras veces es instalar malware, sabotear sistemas, o robar dinero a través de fraudes.</p>
                        </div>
                    </li>
                    <li>
                        <time class="cbp_tmtime"><span>4/11/13</span> <span>12:04</span></time>
                        <div class="cbp_tmicon cbp_tmicon-screen"></div>
                        <div class="cbp_tmlabel">
                            <h2>Greens radish arugula</h2>
                            <p>Caulie dandelion maize...</p>
                        </div>
                    </li>
                    <li>
                        <time class="cbp_tmtime"><span>4/13/13</span> <span>05:36</span></time>
                        <div class="cbp_tmicon cbp_tmicon-mail"></div>
                        <div class="cbp_tmlabel">
                            <h2>Sprout garlic kohlrabi</h2>
                            <p>Parsnip lotus root...</p>
                        </div>
                    </li>
                    <li>
                        <time class="cbp_tmtime"><span>{{$now->format('d/m/y')}}</span> <span>{{$now->format('G:m')}}</span></time>
                        <div class="cbp_tmicon cbp_tmicon-phone"></div>
                        <div class="cbp_tmlabel">
                            <h2>Watercress ricebean</h2>
                            <p>Peanut gourd nori...</p>
                        </div>
                    </li>
                    <li>
                        <time class="cbp_tmtime"><span>4/16/13</span> <span>21:30</span></time>
                        <div class="cbp_tmicon cbp_tmicon-earth"></div>
                        <div class="cbp_tmlabel">
                            <h2>Observación N</h2>
                            <p>En seguridad informática, un ataque de denegación de servicio, también llamado ataque DoS (por sus siglas en inglés, Denial of Service), es un ataque a un sistema de computadoras o red que causa que un servicio o recurso sea inaccesible a los usuarios legítimos. Normalmente provoca la pérdida de la conectividad con la red por el consumo del ancho de banda de la red de la víctima o sobrecarga de los recursos computacionales del sistema atacado.</p>
                        </div>
                    </li>
                </ul>
                <!-- Fin linea de tiempo -->
                </div>
            </div>
        </div>
    </div>
</div>  

<!-- Modal cambiar observacion -->
<div class="modal fade" id="modalObservacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content "style="height:600px;width:600px">
            <div class="modal-header custom-color">
                <h5 class="modal-title" id="modalProfileLabel" style="color:white">Observación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label"> Título </label>
                        <input type="text" class="col-md-8" id="titulo" placeholder="Ingrese un título" style="margin-left: 15px;">    
    
                        <label for="name" class="col-md-2 col-form-label" style="margin-top: 10px">{{ __('Categoría') }}</label>
                        <div class="col-md-6" style="margin-top: 10px">
                            <select name="id_rol" class="form-control" id="id_rol">
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->nombre}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <label for="name" class="col-md-2 col-form-label">{{ __('Observacion') }}</label>
                    <div class="col-md-6">
                        <textarea name="comentario" rows="10" cols="70"></textarea>
                    </div>
                    <label for="name" class="col-md-2 col-form-label"> Autor:</label>
                    <label>{{$usuario->name}} </label>
                    <div style="margin-top: 10px">
                        <label for="name" class="col-md-2 col-form-label"> Fecha:</label>
                        <label>{{$now->format('d-m-Y')}} </label>
                    </div>
                <div class="modal-footer">
                    <button style="background-color: #2a9d8f" class="btn btn-info btn-sm">Agregar Observación</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal cambiar datos -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header custom-color">
                <h5 class="modal-title" id="modalProfileLabel" style="color:white">Editar datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                        AQUI VA LO DE EDITAR DATOS
                </div>
                <div class="modal-footer">
                    <button style="background-color: #2a9d8f" class="btn btn-info btn-sm">Guardar Cambios</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
