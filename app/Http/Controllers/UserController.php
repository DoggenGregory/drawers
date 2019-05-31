<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userdb = auth()->user();
        return view('index')->with('userdb', $userdb);
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
    public function edit()
    {
        $user = auth()->user();
        return view('settings', compact('user'));
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
        $user = User::find($id);
        $user->name = $request->get('username');
        $user->email = $request->get('email');

        $oldpw = $request->get('oldpw');
        $newpw = $request->get('newpw');
        $newpw_confirm = $request->get('newpw_confirm');

        if(!empty($oldpw) && Hash::check($oldpw, $user->password)){
            if($newpw == $newpw_confirm){
                $user->password = Hash::make($newpw);
            }else{
                return redirect('settings')->with('error', 'Confirmation password does not match new password.');
            }
        }elseif(empty($oldpw) && (isset($newpw) || isset($newpw_confirm))){
            return redirect('settings')->with('error', 'Please enter old password to save new password.');
        }

        $user->save();

        return redirect('index')->with('status', 'Profile updated!');
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
