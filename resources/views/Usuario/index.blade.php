@extends('layouts.app')

@section('content')


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card margen-card" style="width:800px">
                <div class="card-header shadow-sm custom-recuperarSesion" style="background-color:#577590; color:white">Usuarios
                </div>
                
                <div class="card-body">     
                
                <table id="usuarios" class="table table-striped table-responsive table-hover dt-responsive" style="width:100%">
                        <thead class="thead" style="background-color: #577590; color:white;" >
                            
                            <tr>
                                <th >Nombre</th>
                                <th >Email</th>
                                <th >Habilitado</th>
                                <th >Rol asignado</th>
                                <th > <a href="{{ route('users.create') }}" 
                                        class="btn btn-sm btn-secondary float-cente" style="background-color: #2a9d8f"> 
                                        <i class="fas fa-plus"></i> Crear Usuario </a>&nbsp;</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if($users->count()==0)
                              <tr>
                                  <td><H5>Sin Datos</H5></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                              </tr>
                            @endif
                            @foreach($users as $user)
                                    
                                    <tr>
                                    
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    @if (empty($user->deleted_at))
                                        <td>Si</td>
                                    @else
                                        <td>No</td>
                                    @endif
                                    @if($user->roles->count()>0)
                                    @foreach($user->roles as $rol)
                                        <td>{{$rol->name}}</td>
                                    @endforeach
                                    
                                    @else
                                    <td>Sin Rol</td>
                                    @endif
                                    <td >    <a style="width:54px" href="{{route('users.show',$user->id)}}" 
                                            class="btn btn-secondary btn-sm btn-custom">
                                            <i class="fas fa-search-plus"></i> Ver</a>

                                            <a style="width:74px" href="{{route('users.edit',$user->id)}}" 
                                            class="btn btn-secondary btn-sm btn-custom">
                                            <i class="fas fa-user-edit"></i> Editar</a>
                                            @if(empty($user->deleted_at))
                                                    <button style="width:95px" id="inh"data-toggle="modal" onClick="selUsuario('{{$user->id}}')" data-target="#modalDeshabilitar" class="btn btn-sm btn-warning">
                                                    <span class="fas fa-user-slash"></span> Inhabilitar
                                                    </button>
                                            @else

                                                    <button style="width:85px" id="hab" data-toggle="modal" onClick="selUsuario('{{$user->id}}')" data-target="#modalHabilitar" class="btn btn-sm btn-success" >
                                                    <span class="fas fa-user-check"></span> Habilitar
                                                    </button>
                                            @endif
                                            
                                    </td>

                                         
                                        
                                            
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"defer></script>
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
        $('#usuarios').dataTable({
            responsive: true,
            language : espanol
            

        });
    } );
</script>
</div>
@endsection
