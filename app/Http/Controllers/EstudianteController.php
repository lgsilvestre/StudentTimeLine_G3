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
        $esstudiante->id_carrera=$request->get('id_carrera');

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
        //
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
            'nombre'=>'required|string',
            'ap_Paterno'=>'required|string',
            'ap_Materno'=>'required|string',
            'rut'=>'required|string',
            'matricula'=>'required|string',
            'correo'=>'required|string|unique',
            'nombre_carrera' =>'required|string',
            ]);

        $estudiante=Estudiante::find($id);

        $estudiante->nombre=$request->get('nombre');
        $estudiante->ap_Paterno=$request->get('ap_Paterno');
        $estudiante->ap_Materno=$request->get('ap_Materno');
        $estudiante->rut=$request->get('rut');
        $estudiante->matricula=$request->get('matricula');
        $estudiante->correo=$request->get('correo');
        
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
