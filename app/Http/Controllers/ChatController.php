<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Chat;
use Illuminate\Http\Request;


class ChatController extends Controller
{
	public function index()
	{
		$chat = Chat::all();

//		return view('index', compact('chat'));
		return view('chat', compact('chat'));
	}

	public function saveMessage(Request $request)
	{


		$create = Chat::create([
			'name' => 'potap',
			'message' => $request->data,
		]);
		if ($create)
		{
			event( new NewMessage( $create ) );
			return response()->json(['success' => $create]);
		}else{
			return response()->json(['error' => 'Error']);
		}
	}
}