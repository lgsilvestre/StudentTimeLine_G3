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
                                        <a href="{{ route('rol.create') }}" 
                                        class="btn btn-sm btn-secondary float-left" style="background-color: #2a9d8f"> 
                                        <i class="fas fa-plus"></i> Crear Rol
                                    @endrole
                                </a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($roles->count()==0)
                              <tr>
                                  <td><H5>Sin Datos</H5></td>
                                  <td></td>
                                  <td></td>
                              </tr>
                            @endif
                            @foreach($roles as $role)
                            <tr>
                                
                                <td >{{$role->name}}</td>
                                <td >
                                    
                                        <a style="width:54px" href="{{route('rol.show',$role->id)}}" 
                                        class="btn btn-secondary btn-custom btn-sm"><i class="fas fa-search-plus"></i> Ver</a>
                                    
                                
                                    
                                        <a style="width:68px;"href="{{route('rol.edit',$role->id)}}" 
                                        class="btn btn-secondary btn-custom btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>
                                    
                                

                                        @if(DB::table('role_user')->where('role_id',$role->id)->exists())
                                            <button style="width:83px" data-toggle="modal" data-target="#modalrol_con_usuarios" onClick="selRol('{{$role->id}}')"class="btn btn-danger btn-eliminar btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                        @else   
                                            <button style="width:83px" data-toggle="modal" data-target="#modalrol_sin_usuarios" onClick="selRol('{{$role->id}}')"class="btn btn-danger btn-eliminar btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                        @endif
                                        
                                </td>
                                
                            </tr>
                            @endforeach
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
        $('#roles').dataTable({
            responsive: true,
            language : espanol
            

        });
    } );
</script>
@endsection
