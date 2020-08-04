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
    @php
      $estu = NULL;
    @endphp
    
    @foreach ($estudiantes as $estudiante) 
      @if($estudiante->rut == $rut)
        @php
            $estu = $estudiante;
        @endphp
      @endif
    @endforeach
    

    <tr>
        <td>{{$estu->id_carrera}}</td>
        <td>{{$estu->matricula}}</td>
        <td>{{$estu->rut}}</td>
        <td>{{$estu->nombre}} {{$estudiante->ap_Paterno}} {{$estudiante->ap_Materno}}</td>
        <td>{{$estu->correo}}</td>
        <td>{{$estu->sexo}}</td>
        <td>{{$estu->fech_nac}}</td>
        <td>{{$estu->plan}}</td>
        <td>{{$estu->año_ingreso}}</td>
        <td>{{$estu->via_ingreso}}</td>
        <td>{{$estu->estado_actual}}</td>
        <td>{{$estu->comuna}}</td>
        <td>{{$estu->region}}</td>
        <td>{{$estu->creditos_aprobados}}</td>
        <td>{{$estu->nivel}}</td>
        <td>{{$estu->porc_avance}}</td>
        <td>{{$estu->ult_ptje_prioridad}}</td>
        <td>{{$estu->regular}}</td>
        <td>{{$estu->prom_aprobadas}}</td>
        <td>{{$estu->prom_cursados}}</td>
        @foreach($estu->observaciones as $observacion)
            <td>[Titulo:{{$observacion->titulo}},{{$observacion->descripcion}},{{$observacion->nombre_autor}},
                {{$observacion->tipo_observacion}},{{$observacion->nombre_categoria}},{{$observacion->created_at->format('d/m/y')}}]</td>
        @endforeach
    </tr>
  </tbody>
</table>