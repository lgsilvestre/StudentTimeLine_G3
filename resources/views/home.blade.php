@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card margen-card custom-card">
            <!-- {{ Breadcrumbs::render('home') }}   -->              
                <div class="card-header custom-recuperarSesion custom-header">Carreras</div>
                    <div class="card-body">
                        <div class="row">
                                @foreach($carreras as $carrera)
                                <div class="col-sm-4">
                                    <div class="card shadow p-3 " style="margin-bottom: 10px; border-radius: 25px; background-color: #474747" >
                                        <img class="card-img-top" src="../images/{{$carrera->imagen}}" alt="No image">
                                        <div class="text-center"> <a href="{{route('estudiantes.index',$carrera->id)}}" class="btn btn-info"> Ver más</a></div>       
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
