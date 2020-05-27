<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;
use App\Carrera;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes=Estudiante::all();
        return view('home',compact("estudiantes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carreras=Carrera::all();
        return view('estudiante.create',compact('carreras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $estudiante=new Estudiante();

        $estudiante->nombre=$request->get('nombre');
        $estudiante->ap_Paterno=$request->get('ap_Paterno');
        $estudiante->ap_Materno=$request->get('ap_Materno');
        $estudiante->rut=$request->get('rut');
        $estudiante->matricula=$request->get('matricula');
        $estudiante->correo=$request->get('correo');
        $estudiante->id_carrera=$request->get('id_carrera');
        $estudiante->sexo=$request->get('sexo');
        $estudiante->fech_nac=$request->get('fech_nac');
        $estudiante->plan=$request->get('plan');
        $estudiante->anio_ingreso=$request->get('año_ingreso');
        $estudiante->estado_actual=$request->get('estado_actual');
        $estudiante->comuna=$request->get('comuna');
        $estudiante->region=$request->get('region');
        $estudiante->creditos_aprobados=$request->get('creditos_aprobados');
        $estudiante->nivel=$request->get('nivel');
        $estudiante->porc_avance=$request->get('porc_avance');
        $estudiante->ult_ptje_prioridad=$request->get('ult_ptje_prioridad');
        $estudiante->regular=$request->get('regular');
        $estudiante->prom_aprobadas=$request->get('prom_aprobadas');
        $estudiante->prom_cursados=$request->get('prom_cursados');

        $estudiante->save();
        $estudiantes=Estudiante::all();

        return redirect()->route('estudiante.index',$estudiantes)->with([
            'message'=>'El estudiante ha sido ingresado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estudiante = Estudiante::find($id);
        return view('estudiante.edit',compact('estudiante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validate=$request->validate([
            'nombre'=>'required|string|max:255',
            'ap_Paterno'=>'required|string|max:255',
            'ap_Materno'=>'required|string|max:255',
            'rut'=>'required|string|max:20',
            'matricula'=>'required|string|max:20',
            'correo'=>'required|string|unique',
            'sexo' => 'required|string|max:255',
            'fech_nac' => 'required|date',
            'plan' => 'integer',
            'año_ingreso' => 'integer',
            'estado_actual' => 'string|max:255',
            'comuna' => 'string|max:255',
            'region' => 'integer',
            'creditos_aprobados' => 'required|integer',
            'nivel' => 'required|integer',
            'porc_avance' => 'required|integer',
            'ult_ptje_prioridad' => 'required|decimal',
            'regular' => 'required|boolean',
            'prom_aprobados' => 'required|decimal',
            'prom_cursados' => 'required|decimal',
            ]);

        $estudiante=Estudiante::find($id);

        $estudiante->nombre=$request->get('nombre');
        $estudiante->ap_Paterno=$request->get('ap_Paterno');
        $estudiante->ap_Materno=$request->get('ap_Materno');
        $estudiante->rut=$request->get('rut');
        $estudiante->matricula=$request->get('matricula');
        $estudiante->correo=$request->get('correo');
        $estudiante->id_carrera=$request->get('id_carrera');
        $estudiante->sexo=$request->get('sexo');
        $estudiante->fech_nac=$request->get('fech_nac');
        $estudiante->plan=$request->get('plan');
        $estudiante->anio_ingreso=$request->get('año_ingreso');
        $estudiante->estado_actual=$request->get('estado_actual');
        $estudiante->comuna=$request->get('comuna');
        $estudiante->region=$request->get('region');
        $estudiante->creditos_aprobados=$request->get('creditos_aprobados');
        $estudiante->nivel=$request->get('nivel');
        $estudiante->porc_avance=$request->get('porc_avance');
        $estudiante->ult_ptje_prioridad=$request->get('ult_ptje_prioridad');
        $estudiante->regular=$request->get('regular');
        $estudiante->prom_aprobadas=$request->get('prom_aprobadas');
        $estudiante->prom_cursados=$request->get('prom_cursados');
        
        $estudiante->save();
        $estudiantes=Estudiante::all();

        return redirect()->route('estudiantes.index',$estudiantes)->with([
            'message'=>'Los datos han sido modificados correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Estudiante::destroy($id);
        $estudiantes=Estudiante::all();
        return redirect()->route('estudiantes.index',$estudiantes)->with([
            'message'=>'El estudiante ha sido eliminado correctamente']);
    }
}
