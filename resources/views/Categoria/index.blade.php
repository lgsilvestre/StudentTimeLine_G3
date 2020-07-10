@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card margen-card custom-card">
                                  

                <div class="card-header custom-recuperarSesion" style="background-color:#577590; color:white">Categorías Observaciones</div>

                    <div class="card-body shadow-lg">                   
                    <table id="categorias"class="table table-responsive-sm table-hover shadow" style="width:100%" >
                            <thead class="thead" style="background-color: #577590; color:white;">
                                <tr>
                                    <th>id</th>
                                    <th >Nombre Categoría</th>
                                    <th >
                                        @role('admin')
                                            <a href="#"  data-toggle="modal" data-target="#modal_crear"
                                            class="btn btn-sm btn-secondary float-left" > 
                                            <i class="fas fa-plus"></i> Crear Categoría
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
        
        $('#categorias').dataTable({//en caso de usar serverside se descomenta.
            processing: true,
            serverSide: true,
            language : espanol,
            columnDefs: [
            { orderable: true, className: 'reorder', targets: 0 },
            { orderable: true, className: 'reorder', targets: 1 },
            { orderable: false, targets: '_all' }
            ],
            ajax: "{{route('categoria.index')}}",
            columns : [
                {data: 'id'},
                {data: 'nombre'},
                {defaultContent: "<div class='text-center'><div clas='btn-group'><button class='btn btn-info btnEditar btn-custom btn-sm btnEditar'><i class='fas fa-pencil-alt'></i> Editar</button><button style='margin-left:5px' class='btn btn-danger btn-eliminar btn-sm btnEliminar'><i class='fas fa-trash-alt'></i> Eliminar</button></div></div>"}
            ] 

        });
    } );
</script>
<!-- Modal para eliminar categoria -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header custom-colorAdvertencia">
        <h5 class="modal-title" id="exampleModalLabel" style="color:white">Advertencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Está seguro que desea eliminar la categoría seleccionada?
      </div>
      <div class="modal-footer">  
            <form action="{{ route('categoria.destroy')}}" method="post">
            @csrf
                <input type="hidden" id="id_cat" name="id" value="">
                <button class="btn btn-secondary btn-sm">Confirmar</button>
            </form>

            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para crear categoria -->
<div class="modal fade" id="modal_crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header custom-header custom-color">
        <h5 class="modal-title" id="exampleModalLabel" >Creación Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('categoria.store') }}" method="post">
        @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre categoría') }}</label>

                <div class="col-md-6 inputWithIcon">
                    <input id="nombre" type="text" placeholder="Ejemplo: Eliminación" class="custom-ajusteTextoImagen form-control @error('name') is-invalid @enderror" name="nombre" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <i class="fa fa-tag fa-lg" aria-hidden="true"></i>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>      
        </div>
        <div class="modal-footer">  
                
                    <button class="btn btn-secondary  btn-sm">Confirmar</button>
        </form>

            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para editar categoria -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header custom-color">
        <h5 class="modal-title" id="exampleModalLabel" style="color:white">Editar Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('categoria.update') }}" method="post">
        @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre categoría') }}</label>

                <div class="col-md-6 inputWithIcon">
                    <input type="hidden" id="id_edit" name="id" value="">
                    <input id="nombre_editar" type="text" placeholder="Ejemplo: Eliminación" class="custom-ajusteTextoImagen form-control @error('name') is-invalid @enderror" name="nombre" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <i class="fa fa-tag fa-lg" aria-hidden="true"></i>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>      
        </div>
        <div class="modal-footer">  
                
                    <button class="btn btn-secondary  btn-sm">Confirmar</button>
        </form>

            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).on("click",".btnEliminar",function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    $("#id_cat").val(id);
    $("#modal_eliminar").modal("show");
});

$(document).on("click",".btnEditar",function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    $("#id_edit").val(id);
    $("#nombre_editar").val(nombre);
    $("#modal_editar").modal("show");
});

</script>
@endsection
