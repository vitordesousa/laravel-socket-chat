<?php

namespace App\Http\Controllers\Web;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

class PageController extends Controller
{
	public function welcome(){
		return Inertia::render('Welcome', [
			'canLogin' => Route::has('login'),
			'canRegister' => Route::has('register'),
			'laravelVersion' => Application::VERSION,
			'phpVersion' => PHP_VERSION,
		]);
	}

	public function dashboard(){
		return Inertia::render('Dashboard');
	}

	public function chat(){
		$user = auth()->user();

		if($user->group->name == 'Administrators'){
			return Inertia::render('Chat');
		}

		return Inertia::render('ChatUser');
	}
}
