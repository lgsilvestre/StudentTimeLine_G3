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
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user) 
        <tr>
            <td>{{$user->id_carrera}}</td>
            <td>{{$user->matricula}}</td>
            <td>{{$user->rut}}</td>
            <td>{{$user->nombre}} {{$user->ap_Paterno}} {{$user->ap_Materno}}</td>
            <td>{{$user->correo}}</td>
            <td>{{$user->sexo}}</td>
            <td>{{$user->fech_nac}}</td>
            <td>{{$user->plan}}</td>
            <td>{{$user->año_ingreso}}</td>
            <td>{{$user->via_ingreso}}</td>
            <td>{{$user->estado_actual}}</td>
            <td>{{$user->region}}</td>
            <td>{{$user->creditos_aprobados}}</td>
            <td>{{$user->nivel}}</td>
            <td>{{$user->porc_avance}}</td>
            <td>{{$user->ult_ptje_prioridad}}</td>
            <td>{{$user->regular}}</td>
            <td>{{$user->prom_aprobadas}}</td>
            <td>{{$user->prom_cursadas}}</td>
        </tr>
    @end
  </tbody>
</table>