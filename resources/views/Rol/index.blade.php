@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card margen-card " >
            @role('admin')
                <div class="card-header custom-recuperarSesion" style="background-color:#577590; color:white">Roles</div>

                <div class="card-body shadow-lg">                   
                <table class="table table-responsive-sm table-striped table-hover shadow p-3" >
                        <thead class="thead" style="background-color: #577590; color:white;">
                            <tr>
                                <th widht="10px">ID</th>
                                <th>Nombre Rol</th>
                                <th colspan="3">
                                    @role('admin')
                                        <a href="{{ route('rol.create') }}" 
                                        class="btn btn-sm btn-secondary float-left" style="background-color: #2a9d8f"> 
                                        <i class="fas fa-plus"></i> Crear Rol
                                    @endrole
                                </a>&nbsp;</th>
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
                                <td>{{$role->id}}</td>
                                <td >{{$role->name}}</td>
                                <td width="10px">
                                    
                                        <a style="width:54px" href="{{route('rol.show',$role->id)}}" 
                                        class="btn btn-secondary btn-custom btn-sm"><i class="fas fa-search-plus"></i> Ver</a>
                                    
                                </td>
                                <td width="10px">
                                    
                                        <a style="width:68px;"href="{{route('rol.edit',$role->id)}}" 
                                        class="btn btn-secondary btn-custom btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>
                                    
                                </td>
                                <td width="10px">

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
                    {{$roles->appends(Request::only(['busqueda']))->render()}}
                </div>
            </div>
        @endrole
        </div>
    </div>
</div>
@endsection
