<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modulo_carrera as Modulo;
use App\Carrera;


class Modulo_carreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = Modulo::all();
        return view('modulos.index',compact("modulos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carreras = Carrera::all();
        return view('modulos.create',compact('carreras'));
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
            'descripcion'=>'required|string|max:255',
        ]);

        $modulo = new Modulo();
        $modulo->descripcion=$request->get('descripcion');
        $modulo->id_carrera=$request->get('id_carrera'); //asignar id directamente
        $modulo->save();
        $modulos=Modulo::all();
        return redirect()->route('modulos.index',$modulos)->with([
            'message'=>'El modulo ha sido ingresado correctamente']);
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
        $modulo = Modulo::find($id);
        return view ('modulos.edit', compact('modulo'));
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
            'descripcion'=>'required|string|max:255',
        ]);
        $modulo = Modulo::find($id);
        $modulo->descripcion=$request->get('descripcion');
        $modulo->id_carrera=$request->get('id_carrera'); //asignar id directamente
        $modulo->save();
        $modulos=Modulo::all();
        return redirect()->route('modulos.index',$modulos)->with([
            'message'=>'El modulo ha sido ingresado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Modulo::destroy($id);
        $modulos=Modulo::all();
        return redirect()->route('modulos.index',$modulos)->with([
            'message'=>'El modulo ha sido eliminado correctamente']);
    }
}
