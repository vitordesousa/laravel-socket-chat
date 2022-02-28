<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
	public function index(){

		$userLogged = auth()->user();
		$conversations = Conversation::with('customer:id,name')->where('emplooyer_id', $userLogged->id)->get();

		return response()->json([
			'conversations' => $conversations,
		], Response::HTTP_OK);
	}
}
