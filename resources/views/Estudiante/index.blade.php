@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card margen-card">
                <div class="card-header custom-recuperarSesion custom-header">Estudiantes</div>
                    <div class="card-body">                   
                    <table id="estudiantes"class="table table-responsive-sm table-striped table-hover shadow" style="width:100%" >
                            <thead class="thead" style="background-color: #577590; color:white;">
                                <tr>
                                    <th >Matrícula</th>
                                    <th >RUT</th>
                                    <th >Apellido Paterno</th>
                                    <th >Apellido Materno</th>
                                    <th >Nombres</th>
                                    <th >Situación académica</th>
                                    <th >Nº de observaciones</th>
                                    <th >
                                        <a href="#"  data-toggle="modal" data-target="#modal_crear"
                                        class="btn btn-sm btn-secondary float-left" style="background-color: #2a9d8f"> 
                                        <i class="fas fa-plus"></i> Crear Estudiante
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
        
        var table = $('#estudiantes').DataTable({//en caso de usar serverside se descomenta.
            processing: true,
            serverSide: true,
            language : espanol,
            rowReorder: true,
            columnDefs: [
            { orderable: true, className: 'reorder', targets: 0 },
            { orderable: true, className: 'reorder', targets: 1 },
            { orderable: false, targets: '_all' }
            ],
            ajax: "{{route('estudiantes.index',$carrera->id)}}",
            columns : [
                {data: 'matricula'},
                {data: 'rut'},
                {data: 'ap_Paterno'},
                {data: 'ap_Materno'},
                {data: 'nombre'},
                {data: 'estado_actual'},
                {data: 'num_observaciones'},
                {defaultContent: "<div class='text-center'><div clas='btn-group'><button class='btn btn-secondary btnEditar btn-custom btn-sm btnEditar'><i class='fas fa-pencil-alt'></i> Ver detalles</button>"}
            ],
        });
    });
    
</script>

@endsection
