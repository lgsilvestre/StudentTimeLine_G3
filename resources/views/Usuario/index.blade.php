@extends('layouts.app')

@section('content')


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card margen-card" >
                <div class="card-header shadow-sm custom-recuperarSesion" style="background-color:#577590; color:white">Usuarios
                </div>
                
                <div class="card-body">     
                
                <table id="usuarios" class="table table-striped table-responsive-sm table-hover " style="width:100%">
                        <thead class="thead" style="background-color: #577590; color:white;" >
                            
                            <tr>
                                <th >Nombre</th>
                                <th >Email</th>
                               
                                <th >Rol asignado</th>
                                <th colspan="3px"> <a href=""  data-toggle="modal" data-target="#modal_crear"
                                        class="btn btn-sm btn-secondary float-cente" style="background-color: #2a9d8f"> 
                                        <i class="fas fa-plus"></i> Crear Usuario </a>&nbsp;</th>
                                
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
            processing: true,
            serverSide: true,
            language : espanol,
            rowReorder: true,
            columnDefs: [
            { orderable: true, className: 'reorder', targets: 0 },
            { orderable: true, className: 'reorder', targets: 1 },
            { orderable: false, targets: '_all' }
            ],
            ajax: "{{route('users.index')}}",
            columns : [
                {data: 'nombre'},
                {data: 'email'},
                {data: 'name'},
                {defaultContent: "<div class='text-center'><div clas='btn-group'><button class='btn btn-secondary btnEditar btn-custom btn-sm btnEditar'><i class='fas fa-pencil-alt'></i> Editar</button><button class='btn btn-warning btn-sm btnEliminar'><i class='fas fa-user-minus'></i> Inhabilitar</button></div></div>"}
            ],
            
            

        });
        obtener_data_eliminar("#usuarios tbody",table);
        obtener_data_editar("#usuarios tbody",table);
    } );

    var obtener_data_eliminar = function(tbody,table){
        $(tbody).on("click",".btnEliminar",function(){
            var data = table.row($(this).parents("tr")).data();
            $("#id_user").val(data.id);
            $("#modal_eliminar").modal("show");
        });
    };

    var obtener_data_editar = function(tbody,table){
        $(tbody).on("click",".btnEditar",function(){
            var data = table.row($(this).parents("tr")).data();
            $("#id_edit").val(data.id);
            $("#nombre_edit").val(data.nombre);
            $("#id_carrera").val(data.id_carrera);
            $("#id_rol").val(data.id_rol);
            $('#email_edit').val(data.email);
            $("#modal_editar").modal("show");
        });
    }
</script>

<!-- Modal para eliminar modulo -->
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
        ¿Está seguro que desea inhabilitar el usuario seleccionado?
      </div>
      <div class="modal-footer">  
            <form action="{{ route('users.destroy')}}" method="post">
            @csrf
                <input type="hidden" id="id_user" name="id" value="">
                <button style="background-color: #2a9d8f; color:white"class="btn btn-info btn-sm">Confirmar</button>
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
        <h5 class="modal-title" id="exampleModalLabel" >Creación Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('users.store') }}" method="post">
        @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                <div class="col-md-6 inputWithIcon">
                    <input id="nombre" type="text" placeholder="Ejemplo: Juan" class="custom-ajusteTextoImagen form-control @error('name') is-invalid @enderror" name="nombre" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <i class="fa fa-user fa-lg" aria-hidden="true"></i>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>     
            <div class="form-group row">
               
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                <div class="col-md-6">
                
                    <div  class="form-group" style="display:inline;">
                    
                        <ul  class="list-unstyled">
                            
                            @foreach($carreras as $carrera)
                                <li>
                                <input name="carreras[]"class="form-check-input" type="checkbox" value="{{$carrera->id}}" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    {{$carrera->nombre}}
                                </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div> 

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Roles') }}</label>

                <div class="col-md-6 inputWithIcon">
                    <i class="fa fa-user-tie fa-lg" aria-hidden="true"></i>
                    <select name="id_rol" class="custom-ajusteTextoImagen form-control" id="exampleFormControlSelect1">
                   @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                    <div class="col-md-6 inputWithIcon">
                        <input id="email" type="email" placeholder="ejemplo@utalca.cl" class="custom-ajusteTextoImagen form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            </div>  

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                <div class="col-md-6 inputWithIcon">
                    <input id="password" type="password" placeholder="••••••••••••••" class="custom-ajusteTextoImagen form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <i id="show_password" class="fa fa-eye-slash fa-lg icon" type="button" onclick="mostrarPassword()"></i>

                    <script type="text/javascript">
                                
                        function mostrarPassword(){
                            var cambio = document.getElementById("password");
                                
                                if(cambio.type == "password"){
                                    cambio.type = "text";
                                    
                                    $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                                }
                                
                                else{
                                    cambio.type = "password";
        
                                    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                                }                           
                            } 
                    </script>
                        
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                    <div class="col-md-6 inputWithIcon">
                        <input id="password-confirm" type="password" placeholder="••••••••••••••" class="custom-ajusteTextoImagen form-control" name="password_confirmation" required autocomplete="new-password">
                        <i class="fa fa-key fa-lg" aria-hidden="true"></i>
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
        <h5 class="modal-title" id="exampleModalLabel" >Edición Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('users.update') }}" method="post">
        @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                <div class="col-md-6 inputWithIcon">
                    <input id="nombre_edit" type="text" placeholder="Ejemplo: Juan" class="custom-ajusteTextoImagen form-control @error('name') is-invalid @enderror" name="nombre" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <i class="fa fa-user fa-lg" aria-hidden="true"></i>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>     
            <div class="form-group row">
               
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                <div class="col-md-6">
                
                    <div  class="form-group" style="display:inline;">
                    
                        <ul  class="list-unstyled">
                            
                            @foreach($carreras as $carrera)
                                <li>
                                <input name="carreras[]"class="form-check-input" type="checkbox" value="{{$carrera->id}}" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    {{$carrera->nombre}}
                                </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>  

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Roles') }}</label>

                <div class="col-md-6 inputWithIcon">
                    <i class="fa fa-user-tie fa-lg" aria-hidden="true"></i>
                    <select name="id_rol" class="custom-ajusteTextoImagen form-control" id="id_rol">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                    <div class="col-md-6 inputWithIcon">
                        <input id="email_edit" type="email" placeholder="ejemplo@utalca.cl" class="custom-ajusteTextoImagen form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            </div>  

            <!-- <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                <div class="col-md-6">
                    <input id="password_edit" type="password" placeholder="••••••••••••••" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm_edit" type="password" placeholder="••••••••••••••" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
            </div> -->
            

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
