@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card margen-card">
            {{ Breadcrumbs::render('carrera', $carrera) }} 
                    <div class="card-body">     
                    @can('addUser')          
                    <!-- importación masiva -->
                        <form action="{{ route('estudiante.import.excel', $carrera->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row" style="float:left">
                                <div class="col-md-8 custom-file">
                                <input id="file" type="file" class="custom-file-input" name="file" required>
                                <label class="custom-file-label text-truncate" data-browse="Elegir" for="customFile">Importación de Estudiantes</label>
                                </div>
                                <button style="background-color: #2a9d8f; color:white;margin-left:7px"class="btn btn-info  btn-sm">Importar</button>             
                            </div> 
                        </form>
                    <!-- -->
                    @endcan
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
                                    
                                    @can('estudiante.add')
                                        <a href="#"  data-toggle="modal" data-target="#modal-wizard"
                                        class="btn btn-sm btn-secondary float-left" style="background-color: #2a9d8f"> 
                                        <i class="fas fa-plus"></i> Añadir Estudiante
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
<!-- MODAL PARA CREAR ESTUDIANTE CON WIZARD -->
<div id="modal-wizard" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header custom-header custom-color">
        <h5 class="modal-title" id="wizard-title">Creación estudiante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
            <h4>Datos personales</h4>
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

                        <div class="col-sm-3">
                            <label for="inputLastname">Rut</label>
                            <div class="form-group icono-input">
                                <span class="far fa-id-card fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control" id="rut"name="rut" placeholder="14823887-1">
                            </div>
                        </div>
                        <div class="col-sm-3 ">
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

                        <div class="col-sm-3">
                            <label for="inputWebsite">Comuna</label>
                            <div class="form-group icono-input">
                                <span class="fas fa-house-user fa-lg form-control-feedback" aria-hidden="true"></span>
                                <input type="text" class="form-control" id="comuna" name="comuna" placeholder="Curicó">
                            </div>
                        </div>

                    

                    </div>

                </div>

            </div>
            
          </div>


          <div class="tab-pane fade" id="ads" role="tabpanel"  href="#ads">
            <h4>Datos académicos</h4>

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

                        <div class="col-sm-3">
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
        </div>
        <button class="btn btn-secondary" style="background-color: #1d355;" >Guardar</button>
        </form>
        <div class="progress mt-5">
          <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Paso 1 de 2</div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #f94144;">Cancelar</button>
        <!--
        <button class="btn btn-secondary" id="adsBack" style="background-color: #1d355;">Volver</button>
        <button class="btn btn-secondary" id="infoContinue" style="background-color: #1d355;" >Continuar</button> -->
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
