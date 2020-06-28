<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > [Carrera]
Breadcrumbs::for('carrera', function ($trail, $carrera) {
    $trail->parent('home');
    $trail->push($carrera->nombre, route('estudiantes.index', $carrera->id));
});
/* IMPLEMENTAR CUANDO ESTE LA RUTA A UN ESTUDIANTE ESPECIFICO

// Home > [Carrera] > [Estudiante]
Breadcrumbs::for('estudiante', function ($trail, $estudiante) {
    $trail->parent('carrera');
    $trail->push($estudiante->nombre, route('', $estudiante->id));
}); */