<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\newMessage;
use http\Env\Response;
use Illuminate\Http\Request;

class welcome extends Controller
{
    public function index(){
        //event (new newMessage('log deze shit pleas'));
        event(new MessageSent('greg'));
        return view('welcome');
    }

}
