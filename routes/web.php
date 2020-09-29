<?php

use Illuminate\Support\Facades\Route;
use App\Folder\Book;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$data = [
	'namespace' => 'App\Http\Controllers',
];

Route::group($data, function ()
{
//	Route::get('/', 'ChatController@index');
	Route::post('/message', 'ChatController@saveMessage');

});

Route::get('/', function ()
{
	foreach (\App\Models\User::all() as $item)
	{
		dd('https://www.youtube.com/watch?v=BpOu55DLQgU&list=PLD5U-C5KK50WlQNiunPPXSj5jjxVVTPtk&index=7');
	}
});


Route::get('/room/{id}', function ($id)
{
	$room = \App\Models\Room::find($id);
	return view('room', compact('room', 'id'));
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::resource('/book', 'App\Http\Controllers\BookController');










