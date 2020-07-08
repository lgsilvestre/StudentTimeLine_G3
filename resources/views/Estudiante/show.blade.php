@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:40px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header custom-inicioSesion custom-color">{{ __('Línea de Tiempo') }}</div>
                <div class="card-body custom-lineaTiempo">
                    <div class= "custom-foto float-center"></div> 
                    <div class="form-group" style="margin-top:25px; width: 400px;">
                        <ul>Nombre: {{$estudiante->nombre}} {{$estudiante->ap_Paterno}} {{$estudiante->ap_Materno}}</ul>
                        <ul>Rut: {{$estudiante->rut}} </ul>
                        <ul>Correo: {{$estudiante->correo}} </ul>
                        <ul>Matricula: {{$estudiante->matricula}} </ul>
                        <ul>Situacion Academica: {{$estudiante->estado_actual}} </ul>
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
            </div>
        </div>
    </div>
</div>   

<!-- Modal cambiar observacion -->
<div class="modal fade" id="modalObservacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content "style="height:500px;width:600px">
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
                        <label for="name" class="col-md-2 col-form-label">{{ __('Categoría') }}</label>
                        <div class="col-md-6">
                            <select name="id_rol" class="form-control" id="id_rol">
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->nombre}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <label for="name" class="col-md-2 col-form-label">{{ __('Observacion') }}</label>
                    <div class="col-md-6">
                        <textarea name="comentario" rows="10" cols="73"></textarea>
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
