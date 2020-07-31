@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card margen-card">
                <div class="card-header custom-color custom-recuperarSesion">Enviar Recordatorio</div>
                <div class="card-body">
                <label for="">Enviar Correo recordatorio a todos los profesores del sistema, para que realizen su evaluación
                    a sus ayudantes respectivos.</label>
                <div style="margin:auto;text-align: center">
                    <button class="btn btn-md btn-secondary" data-toggle="modal" data-target="#modal_confirmar">Enviar Correos</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_confirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header custom-colorAdvertencia">
        <h5 class="modal-title" id="exampleModalLabel" style="color:white">Advertencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Está seguro que desea enviar un correo a todos los profesores?
      </div>
      <div class="modal-footer">  
            <form action="{{ route('enviarrecordatorio')}}" method="post">
            @csrf
                <button class="btn btn-secondary btn-sm">Confirmar</button>
            </form>

            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
            
      </div>
    </div>
  </div>
</div>
@endsection