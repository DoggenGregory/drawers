<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;



use App\Message;
use App\Events\MessageSent;
use App\Events\drawer;

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

    public function truncate()
    {

            //return Message::truncate();

    }
    public function sendCanvas(Request $request)
    {

        $drawer = auth()->user()->canvas()->create([

            'corX' => $request->drawObject['coordinatesX'][0],
            'corY' => $request->drawObject['coordinatesY'][0],
            'color' => $request->drawObject['color'][0],
            'break' => $request->drawObject['stopLine'][0],
            'thickness'=>$request->drawObject['thickness'][0],


/*            'corX' => 'sdfghjk',
            'corY' => 'ezdyahzdio',
            'color' => 'greg',
            'break' => 'greg',
            'thickness'=>'greg',*/
        ]);
       broadcast(new drawer($drawer->load('user')))->toOthers();

        //return ['status' => 'success'];
        //return $request.coordinatesX.[0];

        return $request;
}
}
