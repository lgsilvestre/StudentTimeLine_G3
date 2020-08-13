@extends('layouts.app')

@section('content')


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card margen-card custom-card" >
                <div class="card-header shadow-sm custom-recuperarSesion" style="background-color:#577590; color:white">Usuarios Inhabilitados
                </div>
                
                <div class="card-body">     
                
                <table id="usuarios" class="table shadow table-responsive-lg table-hover " style="width:100%">
                        <thead class="thead" style="background-color: #577590; color:white;" >
                            
                            <tr>
                                <th >Nombre
                                <a style="marging-left:200px"></a>
                                </th>
                                
                                <th >Email</th>        
                                <th >Rol Asignado</th>
                                <th></th>
                                
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
        var table = $('#usuarios').DataTable({
            serverSide: true,
            language : espanol,
            rowReorder: true,
            columnDefs: [
            { orderable: true, className: 'reorder', targets: 0 },
            { orderable: true, className: 'reorder', targets: 1 },
            { orderable: false, targets: '_all' }
            ],
            ajax: "{{route('users.disable')}}",
            columns : [
                {data: 'nombre'},
                {data: 'email'},
                {data: 'name'},
                {defaultContent: "<div class='text-center'><div clas='btn-group'><button class='btn btn-info btn-sm btnEliminar' style='background-color: #2a9d8f'><i class='fas fa-user-plus'></i> Habilitar</button></div></div>"}
            ],
            
            

        });
        obtener_data_eliminar("#usuarios tbody",table);
    } );

    var obtener_data_eliminar = function(tbody,table){
        $(tbody).on("click",".btnEliminar",function(){
            var data = table.row($(this).parents("tr")).data();
            $("#id_user").val(data.id);
            $("#modal_eliminar").modal("show");
        });
    };

</script>

<!-- Modal para habilitar usuario -->
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
        ¿Está seguro que desea habilitar el usuario seleccionado?
      </div>
      <div class="modal-footer">  
            <form action="{{ route('users.restore')}}" method="post">
            @csrf
                <input type="hidden" id="id_user" name="id" value="">
                <button class="btn btn-secondary btn-sm">Confirmar</button>
            </form>

            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
@endsection