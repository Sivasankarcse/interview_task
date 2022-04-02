<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class FriendList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'friend_id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }
}
