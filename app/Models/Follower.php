<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'following_id', 'role'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function upcomingStreams()
    {
        $currentDate = date('Y-m-d H:i:s');
        return $this->hasMany(StreamManagement::class, 'influencer_id')->where('streamDate', '>', $currentDate);
    }
    public function getFollowing()
    {
        return  $this->hasMany(Follower::class, 'user_id');
    }

    public function getInfluencer()
    {
        return $this->belongsTo(User::class, 'following_id')->where('role', 'Influencer')->withTrashed()->with('followerscount', 'upcomingstreamcount');
    }
}
