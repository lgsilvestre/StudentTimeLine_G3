@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card margen-card custom-card">
            {{ Breadcrumbs::render('carrera', $carrera) }} 

                    <div class="card-body">     
                    <table id="estudiantes"class="table table-responsive-sm table-striped table-hover shadow" style="width:100%" >
                            <thead class="thead" style="background-color: #577590; color:white;">
                                <tr>
                                    <th >Matrícula</th>
                                    <th >RUT</th>
                                    <th >Ap Paterno</th>
                                    <th >Ap Materno</th>
                                    <th >Nombres</th>
                                    <th >Sit. académica</th>
                                    <th >Nº Obs.</th>
                                    <th >
                                    @can('estudiante.add')
                                        <a href="#"  data-toggle="modal" data-target="#modal-wizard"
                                        class="btn btn-md btn-secondary float-left" title="Añadir Estudiante"style="margin-left:5px ;width:37.5px ;background-color: #43aa8b"> 
                                        <i class="fas fa-user-plus"></i> 
                                        </a>
                                    @endcan       

                                    @can('estudiante.add')  
                                        <a href="#"  data-toggle="modal" data-target="#modal_importar"
                                        class="btn btn-md btn-secondary float-left" title="Importar Estudiantes" style="margin-left:4px ;background-color: #55b5b3"> 
                                        <i class="fas fa-file-upload"></i> 
                                        </a>        
                                    @endcan   
                                    @can('estudiante.add')  
                                        <a href="#"  data-toggle="modal" data-target="#modal_exportar"
                                        class="btn btn-md btn-secondary float-left" title="Exportar Estudiantes" style="margin-left:4px; background-color: #f8961e"> 
                                        <i class="fas fa-file-download"></i> 
                                        </a>        
                                    @endcan                           
                                    </th>
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
            bserverSide: true,
            language : espanol,
            rowReorder: true,
            columnDefs: [
            { orderable: true, className: 'reorder dt-body-center', targets: 0 },
            { orderable: true, className: 'reorder dt-body-center', targets: 1 },
            { orderable: false, className: 'reorder dt-body-center', targets: 2 },
            { orderable: false, className: 'reorder dt-body-center', targets: 3 },
            { orderable: true, className: 'reorder dt-body-center', targets: 4 },
            { orderable: false, className: 'reorder dt-body-center', targets: 5 },
            { orderable: false, width: "9%", className:'dt-body-center', targets: 6},
            { orderable: false, width: "20%", className: 'dt-body-center', targets: 7},
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
                {data: 'btn'}
            ],

        });
        
    });
</script>

<!-- Modal para crear Estudiante -->
<div class="modal fade " id="modal_crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header custom-header custom-color">
        <h5 class="modal-title" id="exampleModalLabel" >Creación Estudiante</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="{{ route('estudiante.store',$carrera->id) }}" method="post">
                @csrf
        <div class="modal-body">
        <div class="col-xl-12 mx-auto">
            
                <div class="form-group row">
                    <div class="col-sm-3">
                        
                        <label for="inputFirstname">Matrícula</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="matricula" name="matricula" placeholder="2015307020">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputLastname">Rut</label>
                        <div class="form-group icono-input">
                            <span class="far fa-id-card fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="rut"name="rut" placeholder="14823887-1">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="inputLastname">Correo Electrónico</label>
                        <div class="form-group icono-input">
                            <span class="far fa-envelope fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="correo" name="correo" placeholder="ejemplo@utalca.alumnos.cl">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="inputAddressLine1">Nombres</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Juan Andres">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputAddressLine2">Ap. Paterno</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="ap_Paterno" name="ap_Paterno" placeholder="Pérez">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputAddressLine2">Ap. Materno</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="ap_Materno" name="ap_Materno" placeholder="Soto">
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
                    
                    <div class="col-sm-3 ">
                        <label for="inputState">Sexo</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-venus-mars fa-lg form-control-feedback" aria-hidden="true"></span>
                            <select class="form-control" id="sexo" name="sexo"> 
                                <option>Masculino</option>
                                <option>Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputContactNumber">Fecha de nacimiento</label>
                        <div class="form-group icono-input">
                            <span class="far fa-calendar-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="date" class="form-control" id="fech_nac" name="fech_nac" placeholder="nacimiento">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputContactNumber">Año ingreso</label>
                        <div class="form-group icono-input">
                            <span class="far fa-calendar-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="number" class="form-control" min="1981" id="ano_ingreso" name="ano_ingreso"placeholder="2015">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputContactNumber">Via ingreso</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="via_ingreso" name="via_ingreso" placeholder="Via PSU">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    
                    <div class="col-sm-3">
                        <label for="inputWebsite">Comuna</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-house-user fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="comuna" name="comuna" placeholder="Curicó">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <label for="inputWebsite">Región</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="number" class="form-control" min="1" id="region" name="region" placeholder="7">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <label for="inputWebsite">Nivel</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="number" class="form-control" min="1" max="12" id="nivel" name="nivel" placeholder="11">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="inputWebsite">Plan</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control"  id="plan" name="plan" placeholder="16">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputWebsite">Créditos Aprobados</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="number" class="form-control" min="0" max="400" id="creditos" name="creditos" placeholder="200">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    
                    <div class="col-sm-3">
                        <label for="inputWebsite">Porcentaje Avance</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="number" class="form-control" min="0" max="100"id="porc_avance" name="porc_avance" placeholder="94">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label for="inputWebsite">Último puntaje prioridad</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control"  id="prioridad" name="prioridad" placeholder="700,5">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label for="inputWebsite">Promedio Aprobados</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control"  id="aprobados" name="aprobados" placeholder="5,2">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputWebsite">Promedio Cursados</label>
                        <div class="form-group icono-input">
                            <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                            <input type="text" class="form-control"  id="cursados" name="cursados" placeholder="5,1">
                        </div>
                    </div>
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
<!-- MODAL PARA IMPORTACION DE ESTUDIANTE -->

<div class="modal fade " id="modal_importar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header custom-header custom-color">
        <h5 class="modal-title" id="exampleModalLabel" >Importar Estudiantes</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="{{ route('estudiante.import.excel', $carrera->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
                <div class="col-md-7 custom-file" style="">
                    <input id="file" type="file" class="custom-file-input" name="file" required>
                    <label class="custom-file-label text-truncate" data-browse="Buscar" for="customFile">Importación de Estudiantes</label>
                </div>
        </div>
        <div class="modal-footer">  
            <button style="background-color: #2a9d8f; color:white;margin-left:7px"class="btn btn-info  btn-sm">Importar</button>             
        </form>
            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
       </div>
    </div>
  </div>
</div>

<!-- -->
<!-- MODAL PARA EXPORTAR -->
<div id="modal_exportar" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header custom-header custom-color">
                <h5 class="modal-title" id="wizard-title">Exportar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills nav-stacked justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active btn" data-toggle="tab" href="#Todo" role="tab">Todo</a>
                    <li>
                    <li class="nav-item " style="margin-left:5px">
                        <a class="nav-link btn" data-toggle="tab" href="#porfecha" role="tab">Por fecha</a>
                    <li>
                    <li class="nav-item " style="margin-left:5px">
                        <a class="nav-link btn" data-toggle="tab" href="#individual" role="tab">Individual</a>
                    <li>
                </ul>
                <!-- exportar para todos -->
                <form action="{{ route('estudiante.exportartodo.excel', $carrera->id) }}" method="post">
                @csrf
                <div class="tab-content mt-2">
                    <div class="tab-pane fade show active " id="Todo" role="tabpanel">
                        <div class="form-group">
                            <div class="form-group row justify-content-center">
                                <div class="modal-footer">  
                                    <button id="exportar-todo" class="btn btn-secondary" style="margin-right:7px">Exportar</button>
                                    </form>
                                    <button type="button" class="btn btn-info" data-dismiss="modal" >Cancelar</button>
                                </div>    
                            </div>
                        </div>
                    </div>
                <!--hasta aca -->    
                    <div class="tab-pane fade" id="porfecha" role="tabpanel">
                        <div class="form-group">
                            <div class="col-xl-12 mx-auto">
                                <form action="{{ route('exportrango')}}" method="POST">
                                    @csrf
                                <div class="form-group row justify-content-center">
                                    <label for="inputContactNumber" style="margin-right:7px;margin-top:7px">Fecha inicio</label>
                                        <div class="form-group icono-input">
                                            <span class="far fa-calendar-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                            <input type="date" class="form-control" id="fech_1" name="fech_1" placeholder="Inicial">
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <label for="inputContactNumber" style="margin-right:7px;margin-top:7px">Fecha final</label>
                                        <div class="form-group icono-input">
                                            <span class="far fa-calendar-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                            <input type="date" class="form-control" id="fech_2" name="fech_2" placeholder="Final">
                                        </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <button id="exportar-por-fecha" class="btn btn-secondary" style="margin-right:7px" >Exportar</button>
                                    </form>
                                    <button  type="button" class="btn btn-info" data-dismiss="modal" >Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="individual" role="tabpanel">
                        <div class="form-group">
                            <div class="col-xl-12 mx-auto">
                                <div class="form-group row justify-content-center">
                                    <label for="inputLastname" style="margin-right:7px;margin-top:7px">Rut</label>
                                        <div class="form-group icono-input">
                                            <span class="far fa-id-card fa-lg form-control-feedback" aria-hidden="true"></span>
                                            <input type="text" class="form-control" id="rut"name="rut" placeholder="14823887-1">
                                        </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <button  id="exportar-individual" class="btn btn-secondary" style="margin-right:7px" >Exportar</button>
                                    <button  type="button" class="btn btn-info" data-dismiss="modal" >Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FIN MODAL EXPORTAR -->


<!-- MODAL PARA CREAR ESTUDIANTE CON WIZARD -->
<div id="modal-wizard" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header custom-header custom-color">
        <h5 class="modal-title" id="wizard-title">Creación estudiante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
    
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#infoPanel" role="tab" id="adsBack">Datos personales</a>
          <li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#ads" role="tab" id="infoContinue">Datos académicos</a>
          <li>
        </ul>


        <form action="{{ route('estudiante.store',$carrera->id) }}" method="post">
            @csrf
        <div class="tab-content mt-2">
          <div class="tab-pane fade show active" id="infoPanel" role="tabpanel"  href="#infoPanel">
            <div class="form-group"> 
            
                <div class="col-xl-12 mx-auto">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="inputAddressLine1">Nombres</label>
                                    <div class="form-group icono-input">
                                        <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Juan Andres">
                                    </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="inputAddressLine2">Ap. Paterno</label>
                                    <div class="form-group icono-input">
                                        <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                        <input type="text" class="form-control" id="ap_Paterno" name="ap_Paterno" placeholder="Pérez">
                                    </div>
                        
                        </div>

                        <div class="col-sm-4">
                            <label for="inputAddressLine2">Ap. Materno</label>
                                    <div class="form-group icono-input">
                                        <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                        <input type="text" class="form-control" id="ap_Materno" name="ap_Materno" placeholder="Soto">
                                    </div>
                        
                        </div>
  

                    </div>

                    <div class="form-group row">

                        <div class="col-sm-4">
                            <label for="inputLastname">Rut</label>
                            <div class="form-group icono-input">
                                <span class="far fa-id-card fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control" id="rut"name="rut" placeholder="14823887-1">
                            </div>
                        </div>
                        <div class="col-sm-4 ">
                                <label for="inputState">Género</label>
                                <div class="form-group icono-input">
                                    <span class="fas fa-venus-mars fa-lg form-control-feedback" aria-hidden="true"></span>
                                    <select class="form-control" id="sexo" name="sexo"> 
                                        <option>Masculino</option>
                                        <option>Femenino</option>
                                        <option>Otro</option>
                                    </select>
                                </div>
                        </div>                  
                        <div class="col-sm-4">
                                <label for="inputContactNumber">Fecha de nacimiento</label>
                                <div class="form-group icono-input">
                                    <span class="far fa-calendar-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                    <input type="date" class="form-control" id="fech_nac" name="fech_nac" placeholder="nacimiento">
                                </div>
                        </div>

                    </div>



                    <div class="form-group row">

                        <div class="col-sm-5">
                                <label for="inputLastname">Correo Electrónico</label>
                                <div class="form-group icono-input">
                                    <span class="far fa-envelope fa-lg form-control-feedback" aria-hidden="true"></span>
                                    <input type="text" class="form-control" id="correo" name="correo" placeholder="ejemplo@utalca.alumnos.cl">
                                </div>
                        </div>

                        <div class="col-sm-2">
                                <label for="inputWebsite">Región</label>
                                <div class="form-group icono-input">
                                    <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                    <input type="number" class="form-control" min="1" max="16" id="region" name="region" placeholder="7">
                                </div>
                        </div>

                        <div class="col-sm-5">
                            <label for="inputWebsite">Comuna</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-house-user fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control" id="comuna" name="comuna" placeholder="Curicó">
                            </div>
                        </div>

                    

                    </div>

                </div>
                <div class="float-right">
                    <button id="scheduleContinue" class="btn btn-secondary">Continuar</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal" >Cancelar</button>
                </div>
                <br></br>
            </div>
            
          </div>


          <div class="tab-pane fade" id="ads" role="tabpanel"  href="#ads">

            <div class="form-group">
               <div class="col-xl-12 mx-auto">

                    <div class="form-group row">

                        <div class="col-sm-4">
                            
                            <label for="inputFirstname">Matrícula</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control" id="matricula" name="matricula" placeholder="2015307020">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="inputContactNumber">Año ingreso</label>
                            <div class="form-group icono-input">
                                <span class="far fa-calendar-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="number" class="form-control" min="1981" id="ano_ingreso" name="ano_ingreso"placeholder="2015">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="inputContactNumber">Via ingreso</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control" id="via_ingreso" name="via_ingreso" placeholder="Via PSU">
                            </div>
                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-sm-4">
                                <label for="inputCity">Situación Academica</label>
                                <div class="form-group icono-input">
                                    <span class="fas fa-graduation-cap fa-lg form-control-feedback" aria-hidden="true"></span>
                                    <select class="form-control" id="estado_actual" name="estado_actual">
                                        <option>Regular</option>
                                        <option>No regular</option>
                                    </select>
                                </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="inputWebsite">Nivel</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="number" class="form-control" min="1" max="12" id="nivel" name="nivel" placeholder="11">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="inputWebsite">Plan</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-pencil-alt fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control"  id="plan" name="plan" placeholder="16">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="inputWebsite">Créditos Aprobados</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="number" class="form-control" min="0" max="400" id="creditos" name="creditos" placeholder="200">
                            </div>
                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-sm-3">
                            <label for="inputWebsite">Porcentaje Avance</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="number" class="form-control" min="0" max="100"id="porc_avance" name="porc_avance" placeholder="94">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <label for="inputWebsite">Último puntaje prioridad</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control"  id="prioridad" name="prioridad" placeholder="700,5">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <label for="inputWebsite">Promedio Aprobados</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control"  id="aprobados" name="aprobados" placeholder="5,2">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="inputWebsite">Promedio Cursados</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-hashtag fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control"  id="cursados" name="cursados" placeholder="5,1">
                            </div>
                        </div>
                    </div>
               </div>
               
            </div>
            <div class="float-right">
                <button  class="btn btn-secondary"  >Guardar</button>
                <button  type="button" class="btn btn-info" data-dismiss="modal" >Cancelar</button>
                </form>
            </div>
            <br></br>
           </div>
           
            
         </div>
            <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Paso 1 de 2</div>
            </div> 
    </div>
  </div>
</div>

<!--FIN MODAL PARA CREAR ESTUDIANTE CON WIZARD--->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
        $(document).ready(function(){
            $('.custom-file-input').on('change', function() { 
            console.log("hola");
            let fileName = $(this).val().split('\\').pop(); 
            $(this).next('.custom-file-label').addClass("selected").html(fileName); 
            });
        });    
</script>

<script>
    $(function () {
  $('#modalToggle').click(function() {
    $('#modal').modal({
      backdrop: 'static'
    });
  });

  $('#infoContinue').click(function (e) {
    e.preventDefault();
    $('.progress-bar').css('width', '100%');
    $('.progress-bar').html('Paso 2 de 2');
    $('#myTab a[href="#ads"]').tab('show');
  });

  $('#adsBack').click(function (e) {
    e.preventDefault();
    $('.progress-bar').css('width', '50%');
    $('.progress-bar').html('Paso 1 de 2');
    $('#myTab a[href="#infoPanel"]').tab('show');
  });
  $('#scheduleContinue').click(function (e) {
    e.preventDefault();
    $('.progress-bar').css('width', '100%');
    $('.progress-bar').html('Paso 2 of 2');
    $('#myTab a[href="#ads"]').tab('show');
  });

  $('#activate').click(function (e) {
    e.preventDefault();
    var formData = {
      campaign_name: $('#campaignName').val(),
      start_date: $('#start-date').val(),
      end_date: $('#end-date').val(),
      days: {
        sunday: $('#sunday').prop('checked'),
        monday: $('#monday').prop('checked'),
        tuesday: $('#tuesday').prop('checked'),
        wednesday: $('#wednesday').prop('checked'),
        thurday: $('#thursday').prop('checked'),
        friday: $('#friday').prop('checked'),
        saturday: $('#saturday').prop('checked'),
      },
      start_time: $('#start-time').val(),
      end_time: $('#end-time').val()
    }
    alert(JSON.stringify(formData));
  })
})




</script> 

@endsection
