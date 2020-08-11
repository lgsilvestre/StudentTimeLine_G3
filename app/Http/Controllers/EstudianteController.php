<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;
use App\User;
use App\Carrera;
use App\Categoria;
use App\Modulo_carrera;
use Carbon\Carbon;
use App\Observacion_usuario_estudiante;
use App\Observacion;
use Auth;
use Rut;
use Excel;
use Illuminate\Support\Facades\DB;
use App\Exports\RangoEstudianteExport;
use App\Exports\TodoEstudianteExport;
use App\Exports\UnoEstudianteExport;
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
            return datatables()->of($estudiantes)
                    ->addColumn('btn','actions')
                    ->rawColumns(['btn'])
                    ->toJson();
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
    //    return view('estudiante.create',compact('carreras'));
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
                'matricula'=>'required|string|max:25',
                'rut'=>'required|unique:estudiante|cl_rut',
                'correo'=>'required|string|unique:estudiante',
                'sexo' => 'required|string|max:255',
                'fech_nac' => 'required|date',
                'via_ingreso'=>'required|max:255',
                'ano_ingreso' => 'integer|required',
                'estado_actual' => 'required|string|max:255',
                ]);
            if($request->get('plan')!=''){
                $validate=$request->validate([
                        'plan' => 'integer',
                    ]);
            }
            if($request->get('comuna')!=''){
                
                $validate=$request->validate([
                        'comuna' => 'string|max:255',
                    ]);
            }
            if($request->get('region')!=''){
                $validate=$request->validate([
                        'region' => 'integer',
                    ]);
            }
            if($request->get('creditos')!=''){
                $validate=$request->validate([
                        'creditos' => 'integer',
                    ]);
            }
            if($request->get('nivel')!=''){
                $validate=$request->validate([
                        'nivel' => 'integer',
                    ]);
            }
            if($request->get('porc_avance')!=''){
                $validate=$request->validate([
                        'porc_avance' => 'integer',
                    ]);
            }
            if($request->get('prioridad')!=''){
                $validate=$request->validate([
                        'prioridad' => 'string',
                    ]);
            }
            if($request->get('aprobados')!=''){
                $validate=$request->validate([
                        'aprobados' => 'string',
                    ]);
            }
            if($request->get('cursados')!=''){
                $validate=$request->validate([
                        'cursados' => 'string',
                    ]);
            }
            
        
        $estudiante=new Estudiante();
        $estudiante->nombre=$request->get('nombre');
        $estudiante->ap_Paterno=$request->get('ap_Paterno');
        $estudiante->ap_Materno=$request->get('ap_Materno');
        $estudiante->rut=Rut::parse($request->get('rut'))->fix()->format();
        $estudiante->matricula=$request->get('matricula');
        $estudiante->correo=$request->get('correo');
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
        if($request->estado_actual=="Regular"){
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
        $usuario = User::find(Auth::user()->id);
        $now = Carbon::now();
        $estudiante = Estudiante::find($id);
        $carreras = Carrera::all();
        $modulos = Modulo_carrera::
            where('modulo.id_carrera',"=",$estudiante->id_carrera)
            ->get();

        $detalle_observacion = Observacion_usuario_estudiante::
            where('usuario_observacion_estudiante.id_estudiante',"=",$id)
            ->orderBy('created_at','desc')
            ->get();
        
        $observaciones=[];
        foreach($detalle_observacion as $detalle){
            $observaciones[] = $detalle->observacion;
        }  
        $observaciones = collect($observaciones);

        $categorias = Categoria::all();

        return view('Estudiante.show', compact('estudiante','categorias','usuario','now','modulos', 
                                                'observaciones', 'detalle_observacion','carreras'));
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
     //   return view('estudiante.edit',compact('estudiante'));
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
        $estudiante = Estudiante::find($id);
        if($estudiante->correo != $request->correo){
            $validate=$request->validate([
                'correo'=>'required|string|unique:estudiante',
                ]);
            }
        if($estudiante->rut != $request->rut){
            $validate=$request->validate([
                'rut'=>'cl_rut|unique:estudiante|required|string|max:20',
                ]);
        }

        $validate=$request->validate([
            'nombre'=>'required|string|max:255',
            'ap_Paterno'=>'required|string|max:255',
            'ap_Materno'=>'required|string|max:255',
            'matricula'=>'required|string|max:25',
            'sexo' => 'required|string|max:255',
            'fech_nac' => 'required|date',
            'via_ingreso'=>'required|max:255',
            'ano_ingreso' => 'integer|required',
            'estado_actual' => 'required|string|max:255',
            ]);
        if($request->get('plan')!=''){
            $validate=$request->validate([
                    'plan' => 'integer',
                ]);
        }
        if($request->get('comuna')!=''){
            $validate=$request->validate([
                    'comuna' => 'string|max:255',
                ]);
        }
        if($request->get('region')!=''){
            $validate=$request->validate([
                    'region' => 'integer',
                ]);
        }
        if($request->get('creditos')!=''){
            $validate=$request->validate([
                    'creditos' => 'integer',
                ]);
        }
        if($request->get('nivel')!=''){
            $validate=$request->validate([
                    'nivel' => 'integer',
                ]);
        }
        if($request->get('porc_avance')!=''){
            $validate=$request->validate([
                    'porc_avance' => 'integer',
                ]);
        }
        if($request->get('prioridad')!=''){
            $validate=$request->validate([
                    'prioridad' => 'string',
                ]);
        }
        if($request->get('aprobados')!=''){
            $validate=$request->validate([
                    'aprobados' => 'string',
                ]);
        }
        if($request->get('cursados')!=''){
            $validate=$request->validate([
                    'cursados' => 'string',
                ]);
        }
        
        $estudiante->nombre=$request->get('nombre');
        $estudiante->ap_Paterno=$request->get('ap_Paterno');
        $estudiante->ap_Materno=$request->get('ap_Materno');
        $estudiante->rut=Rut::parse($request->get('rut'))->fix()->format();
        $estudiante->matricula=$request->get('matricula');
        $estudiante->correo=$request->get('correo');
        $estudiante->id_carrera=$request->get('carrera');
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
        if($request->estado_actual=="Regular"){
            $estudiante->regular="Si";
        }else{
            $estudiante->regular="No";
        }
        
        $estudiante->prom_aprobadas=$request->get('aprobados');
        $estudiante->prom_cursados=$request->get('cursados');
       
        $estudiante->save();

        return redirect()->action('EstudianteController@show', $id)
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

        $validate=$request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);
        /* try{ */
            $file =  $request->file('file');
            Excel::import(new EstudianteImport($carrera->id), $file);
            return redirect()->action('EstudianteController@index',$carrera)
            ->with('success','Estudiantes ingresados con éxito'); 
        /* } */
        /* catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->action('EstudianteController@index', $carrera)
             ->with('error','El archivo no tiene el formato correcto o los datos ya han sido ingresados'); 
            
        } */
    }
    public function exportarRangoFechas(Request $request){
        $export = new RangoEstudianteExport($request->get('fech_1'),$request->get('fech_2'));
        return $export->download('estudiantes.xlsx');   
    }

    public function exportarTodo(Request $request){
        $export = new TodoEstudianteExport($request);
        return $export->download('estudiantesTodo.xlsx'); 
    }

    public function exportarUno(Request $request){
        $validate=$request->validate([
            'rut'=>'cl_rut|required|string|max:20',
            ]);
        $rut = Rut::parse($request->get('rut'))->fix()->format();
        $export = new UnoEstudianteExport($rut);
        return $export->download('estudiante.xlsx');
    }
}
