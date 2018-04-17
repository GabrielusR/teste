<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\Profile;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.users.index')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);
        
        $user = User::create([
           'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password')
        ]);
        
        $profile = Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/default.jpg'
        ]);
        
        Session::flash('success', 'Novo usuário criado!');
        
        return redirect()->route('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $user = User::find($id);
        
        $user->delete();
        
        Session::flash('success', 'Conta de usuário descartada com sucesso!');
        
        return redirect()->back();
    }
    
    
    public function trash()
    {
        $users = User::onlyTrashed()->get();
        
        return view('admin.users.trash')->with('users', $users);
    }
    
    public function kill($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        
        $user->profile->delete();
        
        $user->forceDelete();
        
        Session::flash('success', 'Conta de usuário excluída permanentemente!');
        
        return redirect()->back();
    }
    
    public function restore($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        
        $user->restore();
        
        Session::flash('success', 'Conta de usuário restaurada!');
        
        return redirect()->route('users');
    }
    
    public function admin($id)
    {
        $user = User::find($id);
        
        $user->admin = 0;
        $user->save();
        
        Session::flash('success', 'Permissões de administrador desativadas!');
        
        return redirect()->back();
    
    }
    
    public function not_admin($id)
    {
        $user = User::find($id);
        
        $user->admin = 1;
        $user->save();
        
        Session::flash('success', 'Permissões de administrador ativadas!');
        
        return redirect()->back();
    }
}
