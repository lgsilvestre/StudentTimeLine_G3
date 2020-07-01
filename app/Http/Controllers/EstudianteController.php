<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;
use App\Carrera;
use Rut;
use Excel;

use App\Imports\EstudianteImport;


class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Carrera $carrera,Request $request)
    {
        $estudiantes=$carrera->estudiantes();
        if($request->ajax()){
            return datatables()->of($estudiantes)->toJson();
        }
        return view('Estudiante.index',compact('carrera'));
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
    public function store(Request $request,Carrera $carrera)
    {
        
        $validate=$request->validate([
            'nombre'=>'required|string|max:255',
            'ap_Paterno'=>'required|string|max:255',
            'ap_Materno'=>'required|string|max:255',
            'rut'=>'required|unique:estudiante|cl_rut',
            'matricula'=>'required|string|max:25',
            'correo'=>'required|string|unique:estudiante',
            'sexo' => 'required|string|max:255',
            'fech_nac' => 'required|date',
            'plan' => 'required|integer',
            'via_ingreso'=>'required|max:255',
            'ano_ingreso' => 'integer|required',
            'estado_actual' => 'string|max:255',
            'comuna' => 'string|max:255',
            'region' => 'integer|required',
            'creditos' => 'required|integer',
            'nivel' => 'required|integer',
            'porc_avance' => 'required|integer',
            'prioridad' => 'required|string',
            'aprobados' => 'required|string',
            'cursados' => 'required|string',
            ]);
        
        $estudiante=new Estudiante();
        $estudiante->nombre=$request->get('nombre');
        $estudiante->ap_Paterno=$request->get('ap_Paterno');
        $estudiante->ap_Materno=$request->get('ap_Materno');
        $estudiante->rut=Rut::parse($request->get('rut'))->fix()->format();;
        $estudiante->matricula=$request->get('matricula');
        $estudiante->correo=$request->get('correo');
        //Asi si se le pasa el id de carreda directamente
        $estudiante->id_carrera=$carrera->id;
        $estudiante->via_ingreso=$request->get('via_ingreso');
        $estudiante->sexo=$request->get('sexo');
        $estudiante->fech_nac=$request->get('fech_nac');
        $estudiante->plan=$request->get('plan');
        $estudiante->año_ingreso=$request->get('ano_ingreso');
        $estudiante->estado_actual=$request->get('estado_actual');
        $estudiante->comuna=$request->get('comuna');
        $estudiante->region=$request->get('region');
        $estudiante->creditos_aprobados=$request->get('creditos');
        $estudiante->nivel=$request->get('nivel');
        $estudiante->porc_avance=$request->get('porc_avance');
        $estudiante->ult_ptje_prioridad=$request->get('prioridad');
        if($request->estado_actual=="regular"){
            $estudiante->regular="Si";
        }else{
            $estudiante->regular="No";
        }
        
        $estudiante->prom_aprobadas=$request->get('aprobados');
        $estudiante->prom_cursados=$request->get('cursados');

        $estudiante->save();

        return redirect()->action('EstudianteController@index',$carrera)
        ->with('success','Estudiante ingresado con éxito'); 
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
            'carrera'=>'required|string',
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
        //Asi si se le pasa el id de carreda directamente
        //$estudiante->id_carrera=$request->get('id_carrera');
        //Asi cuando se ingresa el nombre de la carrera, puede cambiar despues dependiendo de front
        $nombre_carrera=$request->get('nombre_carrera');
        $carrera=Carrera::where('nombre',$nombre_carrera);
        $estudiante->id_carrera=$carrera->id;
        //hasta aqui
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

        return redirect()->action('EstudianteController@index')
        ->with('success','Estudiante actualizado con éxito');
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
        return redirect()->action('EstudianteController@index')
        ->with('success','Estudiante eliminado con éxito');
    }

    public function importExcel(Request $request, Carrera $carrera){

        $file =  $request->file('file');
        Excel::import(new EstudianteImport, $file);
        return redirect()->action('EstudianteController@index',$carrera)
        ->with('success','Estudiantes ingresados con éxito'); 
    }

}
