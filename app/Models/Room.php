<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $guarded = ['id'];


	public function users()
	{
		return $this->belongsToMany(User::class, 'room_user', 'room_id', 'user_id');
	}

}
