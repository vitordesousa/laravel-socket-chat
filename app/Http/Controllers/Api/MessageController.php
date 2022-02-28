<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    
	public function index(Conversation $conversation, User $user){

        $userLogged = auth()->user();

        if($conversation->emplooyer_id != $userLogged->id){
            return response()->json([], Response::HTTP_UNAUTHORIZED);
        }

        $messages = Message::where('conversation_id', $conversation->id)->orderBy('created_at')->get();

		return response()->json([
			'messages' => $messages,
		], Response::HTTP_OK);
	}
}
