@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card margen-card">
                <div class="card-header shadow-sm custom-recuperarSesion" style="background-color:#577590; color:white">Usuarios</div>
                    <form method="GET" action="{{route('users.index')}}">
                        @csrf
                       
                       <input type="text" name="busqueda" class="form-control "  style="width:200px; margin-left: 35px;" id="busqueda" 
                        placeholder="Buscar" ></input>
                        
                    </form>
                
                <div class="card-body">     
                              
                <table class="table table-responsive table-striped table-hover shadow p-3">
                        <thead class="thead" style="background-color: #577590; color:white;" >
                            <tr>
                                <th class="col-xs-9 col-md-10">Nombre</th>
                                <th class="col-xs-9 col-md-10">Rut</th>
                                <th class="col-xs-9 col-md-9">Habilitado</th>
                                <th class="col-xs-9 col-md-9">Rol asignado</th>
                                <th colspan="3">
                                    @role('admin')
                                        <a href="{{ route('users.create') }}" 
                                        class="btn btn-sm btn-secondary float-left" style="background-color: #2a9d8f"> 
                                        <i class="fas fa-plus"></i> Crear Usuario
                                    @endrole
                                </a>&nbsp;</th>
                                <th class="col-xs-9 col-md-7" colspan="9">&nbsp;</th>
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
                                    <td>{{$user->rut}}</td>
                                    @if (empty($user->deleted_at))
                                        <td>Si</td>
                                    @else
                                        <td>No</td>
                                    @endif
                                    @if($user->roles->count()>0)
                                    <td>Si</td>
                                    @else
                                    <td>No</td>
                                    @endif
                                    <td width="10px">
                                        @can('users.show')<!-- Si tiene permiso para ver usuario se mostrara el boton-->
                                            <a style="width:54px" href="{{route('users.show',$user->id)}}" 
                                            class="btn btn-secondary btn-sm btn-custom">
                                            <i class="fas fa-search-plus"></i> Ver</a>
                                        @endcan
                                    </td>
                                    <td width="10px">
                                        @can('users.edit')<!-- Si tiene permiso para editar usuario se mostrara el boton-->
                                            <a style="width:74px" href="{{route('users.edit',$user->id)}}" 
                                            class="btn btn-secondary btn-sm btn-custom">
                                            <i class="fas fa-user-edit"></i> Editar</a>
                                        @endcan
                                    </td>
                                    
                                    <td width="10px">
                                        
                                        @can('users.destroy')<!-- Si tiene permiso para eliminar usuario se mostrara el boton-->
                                            @if(empty($user->deleted_at))
                                                    <button style="width:95px" id="inh"data-toggle="modal" onClick="selUsuario('{{$user->id}}')" data-target="#modalDeshabilitar" class="btn btn-sm btn-warning">
                                                    <span class="fas fa-user-slash"></span> Inhabilitar
                                                    </button>
                                            @else

                                                    <button style="width:85px" id="hab" data-toggle="modal" onClick="selUsuario('{{$user->id}}')" data-target="#modalHabilitar" class="btn btn-sm btn-success" >
                                                    <span class="fas fa-user-check"></span> Habilitar
                                                    </button>
                                            @endif
                                            
                                        @endcan
                                    </td>
                                    
                                </tr>

                            
                            @endforeach
                        </tbody>
                    </table>
                    {{$users->appends(Request::only(['busqueda','filtro']))->render()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
