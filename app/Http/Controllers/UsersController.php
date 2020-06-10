<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Carrera;
use DB;
use Caffeinated\Shinobi\Models\Role as Rol;
use App\Usuario_carrera;

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
        ->join('carrera_usuario','role_user.user_id','=','carrera_usuario.id_usuario')
        ->whereNull('users.deleted_at')
        ->select('role_user.user_id','role_user.role_id','users.name as nombre','users.email', 'roles.name','roles.id as id_rol','users.id','carrera_usuario.id_carrera')
        ->get();

        if($request->ajax()){
            return datatables()->of($usuarios)->toJson();

        }
        $carreras = Carrera::all();
        $roles = Rol::all();
        return view('Usuario.index',compact('carreras','roles'));
    }

    //crear index inhabilitados

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
        
        $user_carrera = Usuario_carrera::create([
            'id_carrera' => $request->get('carrera'),
            'id_usuario' => $user->id,
        ]);

        $user->save();

        return redirect()->action('UsersController@index')
        ->with('success','Usuario creado con éxito'); 
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
        return view('Usuario.edit',compact('user','roles'));
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
            'name'=>'required|string',
            'email'=>'required|string|unique',
            'password'=>'required|string|min:8',
            ]);

        $user=User::find($id);

        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->password=$request->get('password');
        
        $user->update($request->all());
        $user->roles()->sync($request->get('roles'));

        $user->save();
        $users=User::all();

        return redirect()->route('users.index',$users)->with([
            'message'=>'El usuario ha sido modificado correctamente.']);
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

        return redirect()->action('UsersController@index')
        ->with('success','Usuario habilitado con éxito');
    }
}
