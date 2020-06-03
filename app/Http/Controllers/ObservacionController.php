<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Observacion;


class ObservacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $observaciones=Observacion::all();
        return view('observacion.index',compact('observaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate=$request->validate([
            'titulo'=>'required|string|max:255',
            'tipo_observacion'=>'required|string|max:15',
            'descripcion'=>'required|string|max:2000',
            'categoria'=>'required|string|max:255',
            'modulo'=>'required|string|max:255',
        ]);

    $observacion=new Observacion();
    $observacion->titulo=$request->get('titulo');
    $observacion->tipo_observacion=$request->get('tipo_observacion');
    $observacion->descripcion=$request->get('descripcion');
    $observacion->categoria=$request->get('categoria');
    $observacion->modulo=$request->get('modulo');

    $observacion->save();
    $observaciones=Observacion::all();
    
    return redirect()->route('observacion.index',$obseraciones)->with([
        'message'=>'La observacion ha sido ingresado correctamente']);

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
        $observacion = Observacion::find($id);
        #falta agregar los módulos y categorias 
        return view('observacion.edit',compact('observacion'));

    
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
            'titulo'=>'required|string|max:255',
            'tipo_observacion'=>'required|string|max:15',
            'descripcion'=>'required|string|max:2000',
            'categoria'=>'required|string|max:255',
            'modulo'=>'required|string|max:255',
        ]);

    $observacion=Observacion::find($id);
    
    $observacion->titulo=$request->get('titulo');
    $observacion->tipo_descripcion=$request->get('tipo_observacion');
    $observacion->descripcion=$request->get('descripcion');
    $observacion->categoria=$request->get('categoria');
    $observacion->modulo=$request->get('modulo');

    $observacion->save();
    $observaciones=Observacion::all();

    return redirect()->route('observacion.index',$obseraciones)->with([
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
        Observacion::destroy($id);
        $observaciones=Observacion::all();
        return redirect()->route('observacion.index',$obseraciones)->with([
            'mesage'=>'La observación ha sido eliminada correctamente']);
    }
}
