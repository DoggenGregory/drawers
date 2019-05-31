<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $userdb = auth()->user();
        return view('profile')->with('userdb', $userdb);
    }

    public function settings()
    {
        $userdb = auth()->user();
        return view('settings')->with('userdb', $userdb);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->save();
    }
}
