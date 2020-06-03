<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Carrera;
use Caffeinated\Shinobi\Models\Role as Rol;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::busqueda($request->get('busqueda'))->withTrashed()->paginate(15);
        return view('Usuario.index',compact('users'));
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
        return view ('home',compact('carreras','roles'));
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
            'name'=>'required|string',
            'email'=>'required|string|unique',
            'password'=>'required|string|min:8',
            ]);
        $user = new User();
        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->password=$request->get('password');

        $user->save();
        $users=User::all();

        return redirect()->route('users.index',$users)->with([
            'message'=>'El usuario ha sido ingresado correctamente.']);
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
    public function destroy($id)
    {
        User::find($id)->delete();
        $users=User::all();

        return redirect()->back()->with('success', 'Inhabilitado correctamente.');
    }
}
