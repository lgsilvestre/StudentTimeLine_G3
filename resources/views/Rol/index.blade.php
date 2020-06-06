@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card margen-card" >
            @role('admin')
                <div class="card-header custom-recuperarSesion" style="background-color:#577590; color:white">Roles</div>

                <div class="card-body shadow-lg">                   
                <table id="roles"class="table table-responsive-sm table-striped table-hover shadow" style="width:100%" >
                        <thead class="thead" style="background-color: #577590; color:white;">
                            <tr>
                            
                                <th >Nombre Rol</th>
                                <th >
                                    @role('admin')
                                        <a href="{{ route('rol.create') }}"  data-toggle="modal" data-target="#modal_crear"
                                        class="btn btn-sm btn-secondary float-left" style="background-color: #2a9d8f"> 
                                        <i class="fas fa-plus"></i> Crear Rol
                                    @endrole
                                </a></th>
                            </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>
                    </table>
                   
                </div>
            </div>
        @endrole
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"defer></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        var espanol={
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
            }
        
        $('#roles').dataTable({//en caso de usar serverside se descomenta.
            processing: true,
            serverSide: true,
            language : espanol,
            ajax: "{{route('rol.index')}}",
            columns : [
                {data: 'name'},
                {defaultContent: "<div class='text-center'><div clas='btn-group'><button class='btn btn-custom btn-sm'><i class='fas fa-pencil-alt'></i> Editar</button><button class='btn btn-danger btn-eliminar btn-sm'><i class='fas fa-trash-alt'></i> Eliminar</button></div></div>"}
            ] 

        });
    } );
</script>

<div class="modal fade" id="modalrol_sin_usuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:red">Advertencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Está seguro?
      </div>
      <div class="modal-footer">  
            <form action="{{ route('rol.destroy')}}" method="post">
            @csrf
                <input type="hidden" id="rol_sin_usuario" name="idrol" value="">
                <button style="color:white"class="btn btn-info btn-sm">Confirmar</button>
            </form>

            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Creación Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('rol.store') }}" method="post">
        <div class="modal-body">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del Rol') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" placeholder="Ejemplo: Administrador" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>    
            <div class="form-group row">
                <label for="slug" class="col-md-4 col-form-label text-md-right">{{ __('URL amigable') }}</label>

                <div class="col-md-6">
                    <input id="slug" type="text" placeholder="Ejemplo: admin" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div> 
            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

                <div class="col-md-6">
                    <input id="slug" type="text" placeholder="Ejemplo: Gestiona el sistema" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>           
        </div>
        <div class="modal-footer">  
                
                    <input type="hidden" id="rol_sin_usuario" name="idrol" value="">
                    <button style="background-color: #2a9d8f; color:white"class="btn btn-info  btn-sm">Crear</button>
        </form>

            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

    selRol = function(idPersona){
        $('#rol_con_usuario').val(idPersona);
        $('#rol_sin_usuario').val(idPersona);
    };

</script>
@endsection
