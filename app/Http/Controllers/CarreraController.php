<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrera;

class CarreraController extends Controller
{

    /*
    Esto es para que se puedan acceder a los metodos solo los usuarios autenticados.
    public function __construct(){
        $this->middleware('auth');
    }
    /*

    /**
     * Display a listing of the carrer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carreras = Carrera::all();
        return view('home',compact('carreras'));
    }

    /**
     * Show the form for creating a new career.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('carrera.create'); 
    }

    /**
     * Store a newly created career in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carrera = new Carrera;  
          
        $carrera = $request->get('nombre');
        $carrera->save();

        $carreras = Carrera::all();
        return redirect()->route('carrera',$carreras)->with([
            'message'=> 'La carrera ha sido ingresada correctamente'
        ]);
               
    }

    /**
     * Display the specified career.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified career.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified career in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nombre'=> 'required|string|unique'
        ]);
        $carrera = Carrera::find($id);
        $carrera->nombre=$request->get('nombre');
        $carrera->save();    
        $carreras = Carrera::all();

        return redirect()->route('carrera',$carreras)->with([
            'message'=>'La carrera ha sido actualizada correctamente']);
            

    }

    /**
     * Remove the specified career from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Carrera::destroy($id);

        $carreras = Carrera::all();

        return redirect()->route('carrera',$carreras)->with([
            'message'=>'La carrera ha sido eliminada correctamente']);
    }
}
