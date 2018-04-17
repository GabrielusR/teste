<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Session;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.profile')->with('user', Auth::user());
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
           'name'  => 'required',
            'email' => 'required|email'
        ]);
        
        $user = User::find($request->id);
        
        if($request->hasFile('avatar')) 
        {
            $avatar = $request->avatar;
            
            $avatar_new_name = time().$avatar->getClientOriginalName();

            $avatar->move('uploads/avatars', $avatar_new_name);
            
            $user->profile->avatar = 'uploads/avatars/'.$avatar_new_name;
            
            $user->profile->save();
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile->about = strip_tags($request->about);
        
        if($request->has('password'))
        {
            $user->password = bcrypt($request->password);
        }
        
        $user->save();
        $user->profile->save();
        
        Session::flash('success', 'Perfil de usuário atualizado!');
        
        return redirect()->back();
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return view('admin.users.edit')->with('user', User::find($id));
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
        $this->validate($request, [
           'name'  => 'required',
            'email' => 'required|email'
        ]);
        
        $user = Auth::user();
        
        if($request->hasFile('avatar')) 
        {
            $avatar = $request->avatar;
            
            $avatar_new_name = time().$avatar->getClientOriginalName();

            $avatar->move('uploads/avatars', $avatar_new_name);
            
            $user->profile->avatar = 'uploads/avatars/'.$avatar_new_name;
            
            $user->profile->save();
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile->about = strip_tags($request->about);
        
        if($request->has('password'))
        {
            $user->password = bcrypt($request->password);
        }
        
        $user->save();
        $user->profile->save();
        
        Session::flash('success', 'Perfil de usuário atualizado!');
        
        return redirect()->back();
    }
}
