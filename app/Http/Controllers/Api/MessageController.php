<?php

namespace App\Http\Controllers\Api;

use App\Events\Chat\SendMessage;
use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStoreRequest;
use Illuminate\Support\Facades\Event;
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

	public function user_index(){

		$userLogged = auth()->user();

		$conversation = Conversation::where([ ['customer_id', '=', $userLogged->id], ['status', '<', 2] ])->first();

		$messages = Message::where('conversation_id', $conversation->id)->with(['conversation:id,emplooyer_id', 'conversation.emplooyer:id,name'])->orderBy('created_at')->get();

		return response()->json([
			'messages' => $messages,
		], Response::HTTP_OK);
	}


	public function store(MessageStoreRequest $request){
	   
		$conversation = Conversation::findOrfail($request->conversation_id);

		if(!$conversation || $conversation->status > 1){
			return response()->json([], Response::HTTP_UNAUTHORIZED);
		}

		try {
			$userLogged = auth()->user();
			$request['user_id'] = $userLogged->id;
			$request['message']	= e($request->message);

			$message = Message::create($request->only('message', 'user_id', 'conversation_id'));

			$to = $conversation->customer_id == $userLogged->id ? $conversation->emplooyer_id : $conversation->customer_id;

			Event::dispatch(new SendMessage($message, $to));

			return response()->json(['message' => $message], Response::HTTP_OK);

		} catch (\Exception $e) {
			Log::error($e->getMessage(), [
				'getLine'		=>  $e->getLine(),
				'getFile'		=>	$e->getFile(),
				'getMessage'	=>	$e->getMessage()
			]);

			return response()->json([], Response::HTTP_INTERNAL_SERVER_ERROR);
		}

	}
}
