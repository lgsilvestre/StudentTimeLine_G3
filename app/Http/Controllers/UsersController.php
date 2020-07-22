<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Carrera;
use DB;
use Caffeinated\Shinobi\Models\Role as Rol;
use App\Usuario_carrera;
use Auth;
use Hash;
use Carbon\Carbon;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuarios = DB::table('role_user')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->join('roles','role_user.role_id','=','roles.id')
        ->whereNull('users.deleted_at')
        ->where('user_id','!=',1)
        ->select('role_user.user_id','role_user.role_id','users.name as nombre','users.email', 'roles.name','roles.id as id_rol','users.id')
        ->get();

        if($request->ajax()){
            return datatables()->of($usuarios)
                ->toJson();

        }
        $carreras = Carrera::all();
        $roles = Rol::all();
        return view('Usuario.index',compact('carreras','roles'));
    }

    //crear index inhabilitados
    public function indexdisable(Request $request)
    {
        $usuarios = DB::table('role_user')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->join('roles','role_user.role_id','=','roles.id')
        ->whereNotNull('users.deleted_at')
        ->select('role_user.user_id','role_user.role_id','users.name as nombre','users.email', 'roles.name','roles.id as id_rol','users.id')
        ->get();

        if($request->ajax()){
            return datatables()->of($usuarios)
                ->toJson();
        }
        $carreras = Carrera::all();
        $roles = Rol::all();
        return view('Usuario.indexinhabilitado',compact('carreras','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carreras = Carrera::all();
        $roles = Rol::all();
        return view ('Usuario.create',compact('carreras','roles'));
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
            'nombre'=>'required|string',
            'email'=>'required|string|unique:users',
            'password'=>'required|string|min:8|confirmed',
            'foto' =>'mimes:jpeg,png,jpg',
        ]);

        $name= null;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $name = time().$file->getClientOriginalExtension();
            $file->move(public_path().'/images/',$name);
        }
        

        $user = User::create([
                'name' => $request->get('nombre'),
                'email_verified_at' => now(),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                
            ]);
        
        $role = Rol::find($request->get('id_rol')); 
        $user->assignRoles($role->slug);
        $user->imagen = $name;    
        if($role->slug=="admin"){
            $carreras = Carrera::all();
            foreach($carreras as $carrera){
                $user_carrera = Usuario_carrera::create([
                    'id_carrera' => $carrera->id,
                    'id_usuario' => $user->id,
                ]);
            }
        }else{//se toman las carreras que se entregan desde el request
            foreach($request->carreras as $carrera){
                $user_carrera = Usuario_carrera::create([
                    'id_carrera' => $carrera,
                    'id_usuario' => $user->id,
                ]);
            }
        }
        
        
        $user->save();

        return redirect()->action('UsersController@index')
        ->with('success','Usuario creado con éxito');   
    }
    public function store_Profesor(Request $request)
    {
        $name= null;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);
        }

        $validate=$request->validate([
            'nombre'=>'required|string',
            'email'=>'required|string|unique:users',
            'password'=>'required|string|min:8|confirmed',
            ]);

        $user = User::create([
                'name' => $request->get('nombre'),
                'email_verified_at' => now(),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                
            ]);
        
        $role = Rol::find($request->get('id_rol')); 
        $user->email_verified_at = now();
        $user->assignRoles($role->slug);
        $user->imagen = $name;    
        if($role->slug=="admin"){
            $carreras = Carrera::all();
            foreach($carreras as $carrera){
                $user_carrera = Usuario_carrera::create([
                    'id_carrera' => $carrera,
                    'id_usuario' => $user->id,
                ]);
            }
        }else{//se toman las carreras que se entregan desde el request

            foreach($request->carreras as $carrera){
                $user_carrera = Usuario_carrera::create([
                    'id_carrera' => $carrera,
                    'id_usuario' => $user->id,
                ]);
            }
        }
        
         
        $user->save();

        return redirect()->route('home')
        ->with('success','Profesor creado con éxito');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return View('Usuario.ver');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //administrador????
        $user=User::find($id);
        $roles=Rol::all();
        $carreras=Carrera::all();
        return view('Usuario.edit',compact('user','roles', 'carreras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->get('id'));
        if($user->email == $request->email){
            $validate=$request->validate([
                'nombre'=>'required|string',
                'carreras'=>'required',
            ]);
        }else{
            $validate=$request->validate([
                'nombre'=>'required|string',
                'email'=>'required|string|unique:users',
                'carreras'=>'required',
            ]);
        }
        

        
        $user->name = $request->get('nombre');
        $user->email = $request->get('email');


        $role = Rol::find($request->get('id_rol')); 
        $user->syncRoles($role->slug);
        $user_carrera_del = DB::table('carrera_usuario')
                        ->where('carrera_usuario.id_usuario','=',$request->get('id'))
                        ->delete();
        foreach($request->carreras as $carrera){
            $user_carrera = Usuario_carrera::create([
                'id_carrera' => $carrera,
                'id_usuario' => $user->id,
            ]);
        }
        $user->save();

        return redirect()->action('UsersController@index')
        ->with('success','Usuario actualizado con éxito');  
    }

    public function updateContrasena(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $validate=$request->validate([
            'old_password'=>'required|string',
            'password'=>'required|string|min:8|confirmed|different:old_password',
        ]);
        if(Hash::check($request->old_password,$user->password)){
            $user->password = Hash::make($request->password);
            $user->save();
            return  redirect()->back()->with('success', 'Contraseña actualizada con éxito');
        }else{
            return  redirect()->back()->with('error', 'Contraseña antigua erronea');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::find($request->get('id'))->delete();

        return redirect()->action('UsersController@index')
        ->with('success','Usuario Inhabilitado con éxito'); 
    }

    public function restore(Request $request)
    {
        $user = User::onlyTrashed()->find($request->get('id'))->restore();

        return redirect()->action('UsersController@indexDisable')
        ->with('success','Usuario habilitado con éxito');
    }

    public function editDatosPersonales(User $user)
    {
        return view('Usuario.perfil', compact('user'));
    }  
    
    public function postProfileImage(Request $request){
        
        $user = User::find(Auth::user()->id);
        
        $validate=$request->validate([
            'foto' => 'required|mimes:jpg,png,jpeg',
        ]);

        $newname=null;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $newname = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$newname);
        }

        $user->imagen = $newname;
        $user->save();

        return  redirect()->back()->with('success', 'Foto cambiada con éxito');      
    }
    
}
