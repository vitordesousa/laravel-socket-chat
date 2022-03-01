<?php

namespace App\Http\Controllers\Api;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ConversationController extends Controller
{
	public function admin_index()
	{
		$userLogged = auth()->user();
		if($userLogged->group->name != 'Administrators'){
			return response()->json([], Response::HTTP_UNAUTHORIZED);
		}

		$conversations = Conversation::with('customer:id,name', 'messages:created_at')->where([ ['emplooyer_id', '=', $userLogged->id], ['status', '<', 2] ])->get();

		return response()->json([
			'conversations' => $conversations,
		], Response::HTTP_OK);
	}

	public function user_index(){

		$userLogged = auth()->user();
		
		if($userLogged->group->name == 'Administrators'){
			return response()->json([], Response::HTTP_UNAUTHORIZED);
		}

		$conversations = Conversation::with('emplooyer:id,name')->where([ ['customer_id', '=', $userLogged->id], ['status', '<=', 1] ])->first();

		return response()->json([
			'conversations' => $conversations,
		], Response::HTTP_OK);
	}


}
