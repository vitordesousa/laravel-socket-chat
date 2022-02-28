<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
	public function index(){
		$userGroup = Group::where('name', 'Users')->first();
		$users = User::select('id', 'name')->where('group_id', $userGroup->id)->get();
		return response()->json([
			'users' => $users,
		], Response::HTTP_OK);
	}
}
