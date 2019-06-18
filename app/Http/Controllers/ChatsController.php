<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Message;
use App\Events\MessageSent;
use App\Events\drawer;
use App\Canvas;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chats');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $message = auth()->user()->messages()->create([
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return ['status' => 'success'];
    }

    // public function truncate()
    // {

            //return Message::truncate();
    // }


    public function sendCanvas(Request $request)
    {
        $drawers = auth()->user()->canvas()->create([
            'corX' => $request->drawObject['coordinatesX'],
            'corY' => $request->drawObject['coordinatesY'],
            'color' => $request->drawObject['color'],
            'thickness' => $request->drawObject['thickness'],
            'break' => $request->drawObject['stopLine'],

        ]);

        broadcast(new drawer($drawers->load('user')))->toOthers();

        return ['status' => 'success'];
    }

    public function fetchCanvas()
    {
        return Canvas::with('user')->get();
    }
    public function getCanvas(){
        return Canvas::with('user')->get();
    }
}
