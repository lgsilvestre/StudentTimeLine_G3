<?php
use App\Carrera;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > [Carrera]
Breadcrumbs::for('carrera', function ($trail, $carrera) {
    $trail->parent('home');
    $trail->push($carrera->nombre, route('estudiantes.index', $carrera));
});


// Home > [Carrera] > [Estudiante]
Breadcrumbs::for('estudiante', function ($trail, $estudiante) {
    $carrera=Carrera::find($estudiante->id_carrera);
    $trail->parent('carrera', $carrera);
    $name=$estudiante->nombre." ".$estudiante->ap_Paterno." ".$estudiante->ap_Materno;
    $trail->push($name, route('estudiante.show', $estudiante));
}); 