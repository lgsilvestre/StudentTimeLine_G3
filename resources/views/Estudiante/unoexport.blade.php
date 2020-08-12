<table class="table">
  <thead>
    <tr>
      <th scope="col">COD_CARRERA</th>
      <th scope="col">MATRICULA</th>
      <th scope="col">RUN</th>
      <th scope="col">NBE_ALUMNO</th>
      <th scope="col">CORREO</th>
      <th scope="col">SEXO</th>
      <th scope="col">FECHA_NAC</th>
      <th scope="col">PLAN</th>
      <th scope="col">ANHO_INGRESO</th>
      <th scope="col">VIA_INGRESO</th>
      <th scope="col">SIT_ACTUAL</th>
      <th scope="col">COMUNA</th>
      <th scope="col">REGION</th>
      <th scope="col">CRED_APROBADOS</th>
      <th scope="col">NIVEL</th>
      <th scope="col">PORC_AVANCE</th>
      <th scope="col">ULT_PTJE_PRIORIDAD</th>
      <th scope="col">REGULAR</th>
      <th scope="col">PROM_APROBADAS</th>
      <th scope="col">PROM_CURSADAS</th>
      <th scope="col">OBSERVACIONES</th>
      
    </tr>
  </thead>
  <tbody>
    
    
    <tr>
        @php
              $carrera = App\Carrera::find($estudiante->id_carrera);
        @endphp
        <td>{{$carrera->codigo_carrera}}</td>
        <td>{{$estudiante->matricula}}</td>
        <td>{{$estudiante->rut}}</td>
        <td>{{$estudiante->nombre}} {{$estudiante->ap_Paterno}} {{$estudiante->ap_Materno}}</td>
        <td>{{$estudiante->correo}}</td>
        <td>{{$estudiante->sexo}}</td>
        <td>{{$estudiante->fech_nac}}</td>
        <td>{{$estudiante->plan}}</td>
        <td>{{$estudiante->año_ingreso}}</td>
        <td>{{$estudiante->via_ingreso}}</td>
        <td>{{$estudiante->estado_actual}}</td>
        <td>{{$estudiante->comuna}}</td>
        <td>{{$estudiante->region}}</td>
        <td>{{$estudiante->creditos_aprobados}}</td>
        <td>{{$estudiante->nivel}}</td>
        <td>{{$estudiante->porc_avance}}</td>
        <td>{{$estudiante->ult_ptje_prioridad}}</td>
        <td>{{$estudiante->regular}}</td>
        <td>{{$estudiante->prom_aprobadas}}</td>
        <td>{{$estudiante->prom_cursados}}</td>
        @foreach($estudiante->observaciones as $observacion)
        <td>[Titulo: {{$observacion->titulo}}, Descripción: {{$observacion->descripcion}}, Autor: {{$observacion->nombre_autor}}, Tipo: 
                       {{$observacion->tipo_observacion}}, Categoría: {{$observacion->nombre_categoria}}, Módulo: {{$observacion->modulo}}, Fecha: {{$observacion->created_at->format('d/m/y')}}]</td>
        @endforeach
    </tr>
  </tbody>
</table>