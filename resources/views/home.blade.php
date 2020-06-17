@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card margen-card custom-card">
                                  
                <div class="card-header custom-recuperarSesion custom-header">Carreras</div>
                    <div class="card-body">
                        <div class="row">
                                @foreach($carreras as $carrera) 
                                <div class="col-sm-4">
                                    <div class="card shadow p-3" style="margin-bottom: 10px" >
                                        <img class="card-img-top" src="../images/{{$carrera->imagen}}" alt="No image">
                                        <div class="card-body"> 
                                           <hr class="my-4" style="border: 1px solid black"></hr> 
                                           <h4 class="card-title text-sm-center" style="font-size: 18px"> {{  $carrera->nombre  }}</h4>
                                            <div class="text-center"> <a href="{{route('estudiantes.index',$carrera->id)}}" class="btn btn-info"> Ver más</a></div> 
                                        </div>
                                        
                                    </div>
                                </div>
                                @endforeach      
                        </div>
                    </div>
                    
            </div>
        </div>
    </div>
</div>
@endsection