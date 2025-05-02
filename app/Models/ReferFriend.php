<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferFriend extends Model
{
    use HasFactory;
    public function getRefer()
    {
        return $this->belongsTo(User::class, 'user_id')->where('role', 'User')->withTrashed();;
    }
}
