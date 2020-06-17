<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrera;
use App\User;
use Auth;

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
        $user = User::find(Auth::user()->id);
        if($user->id == 1){
            $carreras = Carrera::all();
        }else{
            $carreras = $user->usuario_carrera;
            dump($carreras);
            $collect = [];
            foreach($carreras as $carrera){
                $car = $carrera->carrera;
                $collect[]=$car; 
            }
            $carreras = collect($collect);
        }
        
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
        $validate = $request->validate([
            'nombre'=> 'required|string|unique',
            'codigo_carrera'=> 'required|integer|unique'
        ]);
        $carrera = new Carrera;  
          
        $carrera->nombre = $request->get('nombre');
        $carrera->codigo_carrera = $request->get('codigo_carrera');
        $carrera->save();

        $carreras = Carrera::all();
        return redirect()->route('carrera.index',$carreras)->with([
            'message'=> 'La carrera ha sido ingresada correctamente.'
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
        $carrera = Carrera::find($id);
        return view('carrera.edit',compact('carrera'));
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
            'nombre'=> 'required|string|unique',
            'codigo_carrera'=> 'required|integer|unique'
        ]);

        $carrera = Carrera::find($id);
        $carrera->nombre=$request->get('nombre');
        $carrera->codigo_carrera=$request->get('codigo_carrera');
        $carrera->save();    
        $carreras = Carrera::all();

        return redirect()->route('carrera.index',$carreras)->with([
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
        return redirect()->route('carrera.index',$carreras)->with([
            'message'=>'La carrera ha sido eliminada correctamente']);
    }
}
