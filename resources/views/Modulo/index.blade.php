@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card margen-card custom-card">
                                  

                <div class="card-header custom-recuperarSesion custom-header">Módulos de carreras</div>

                    <div class="card-body shadow-lg">                   
                    <table id="modulos"class="table table-responsive-sm table-hover shadow" style="width:100%" >
                            <thead class="thead" style="background-color: #577590; color:white;">
                                <tr>
                                    <th >Nombre Modulo</th>
                                    <th class="no-sort">Nombre Carrera</th>
                                    <th >
                                        @role('admin')
                                            <a href="#"  data-toggle="modal" data-target="#modal_crear"
                                            class="btn btn-sm btn-secondary float-left" style="background-color: #2a9d8f"> 
                                            <i class="fas fa-plus"></i> Crear Modulo
                                        @endrole
                                    </a></th>
                                </tr>
                            </thead>
                            <tbody>
                        
                            </tbody>
                        </table>
                    
                    </div>
                  </div>
                </div>
            </div>
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
        
        var table = $('#modulos').DataTable({//en caso de usar serverside se descomenta.
            processing: true,
            serverSide: true,
            language : espanol,
            rowReorder: true,
            columnDefs: [
            { orderable: true, className: 'reorder', targets: 0 },
            { orderable: true, className: 'reorder', targets: 1 },
            { orderable: false, targets: '_all' }
            ],
            ajax: "{{route('modulo.index')}}",
            columns : [
                {data: 'descripcion'},
                {data: 'nombre'},
                {defaultContent: "<div class='text-center'><div clas='btn-group'><button class='btn btn-secondary btnEditar btn-custom btn-sm btnEditar'><i class='fas fa-pencil-alt'></i> Editar</button><button class='btn btn-danger btn-eliminar btn-sm btnEliminar'><i class='fas fa-trash-alt'></i> Eliminar</button></div></div>"}
            ],
        });
        obtener_data_eliminar("#modulos tbody",table);
        obtener_data_editar("#modulos tbody",table);
    });
    var obtener_data_editar = function(tbody,table){
        $(tbody).on("click",".btnEditar",function(){
            var data = table.row($(this).parents("tr")).data();
            var idmodulo = $("#id_edit").val(data.id);
            $("#nombre_edit").val(data.descripcion);
            $("#carreras_select").val(data.id_carrera);
            $("#modal_editar").modal("show");
        });
    };

    var obtener_data_eliminar = function(tbody,table){
        $(tbody).on("click",".btnEliminar",function(){
            var data = table.row($(this).parents("tr")).data();
            var idmodulo = $("#id_mod").val(data.id);
            $("#modal_eliminar").modal("show");
        });
    }
</script>

<!-- Modal para eliminar modulo -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="{{ route('modulo.destroy')}}" method="post">
            @csrf
                <input type="hidden" id="id_mod" name="id" value="">
                <button style="color:white"class="btn btn-info btn-sm">Confirmar</button>
            </form>

            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para crear modulo -->
<div class="modal fade" id="modal_crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header custom-header">
        <h5 class="modal-title" id="exampleModalLabel" >Creación Módulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('modulo.store') }}" method="post">
        @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Descripción Modulo') }}</label>

                <div class="col-md-6">
                    <input id="nombre" type="text" placeholder="Ejemplo: Plan 16 - Álgebra" class="form-control @error('name') is-invalid @enderror" name="descripcion" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>     
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>

                <div class="col-md-6">
                <select name="carrera" class="form-control" id="exampleFormControlSelect1">
                   @foreach($carreras as $carrera)
                        <option value="{{$carrera->id}}">{{$carrera->nombre}}</option>
                    @endforeach
                </select>
                </div>
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

<!-- Modal para editar modulo -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header custom-header">
        <h5 class="modal-title" id="exampleModalLabel" >Editar Módulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('modulo.update') }}" method="post">
        @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Descripción Modulo') }}</label>

                <div class="col-md-6">
                    <input id="nombre_edit" type="text" placeholder="Ejemplo: Plan 16 - Álgebra" class="form-control @error('name') is-invalid @enderror" name="descripcion" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>     
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>

                <div class="col-md-6">
                <select name="carrera" class="form-control" id="carreras_select">
                   @foreach($carreras as $carrera)
                        <option value="{{$carrera->id}}">{{$carrera->nombre}}</option>
                    @endforeach
                </select>
                </div>
            </div>  
        </div>
        <div class="modal-footer">  
                    <input type="hidden" id="id_edit" name="id" value="">
                    <button style="background-color: #2a9d8f; color:white"class="btn btn-info  btn-sm">Confirmar</button>
        </form>

            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
@endsection