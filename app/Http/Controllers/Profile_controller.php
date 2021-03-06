<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class Profile_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        return view('admin.user.profile')->with('user',$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
          $validatdata = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'about'=>'required',
            'facebook'=>'required|url',
            'youtube'=>'required|url',
            'password'=>'required',

        ]);

        $user = Auth::user();


        if($request->hasFile('avatar'))
        {
            $avatar = $request->avatar;
            $avatar_new_name = time().$avatar->getClientOriginalName();
            $avatar->move('uploads/avatar/',$avatar_new_name);
            $user->profile->avatar = 'uploads/avatar/'. $avatar_new_name;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        //$user->password = bcrypt($request->password); or if statment
        $user->profile->facebook = $request->facebook;
        $user->profile->youtube = $request->youtube;
        $user->profile->about = $request->about;
     
        if($request->has('password'))
        {

        $user->password = bcrypt($request->password);
        $user->save();
        }
        $user->save();
        $user->profile->save();
        Session::flash('success','profile updated succesfuly');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
