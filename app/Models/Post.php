<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    public function getInfluencer()
    {
        return $this->belongsTo(User::class, 'infulencer_id')->withTrashed();
    }

    protected $dates = ['deleted_at'];
    protected $fillable = ['influencer_id', 'title', 'location','description', 'status', 'is_blocked'];
    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function getInfluencers()
    {
        return $this->belongsTo(User::class, 'influencer_id')->where('role', 'Influencer')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
    public function countComent()
    {
        return $this->hasMany(PostComment::class, 'post_id');
    }

    public function countLike()
    {
        return $this->hasMany(PostLike::class, 'post_id');
    }
    public function lastOrder()
    {
        return $this->hasOne(PostLike::class, 'user_id', 'id')->orderBy('id', 'DESC')->limit(1);
    }

    public function userLikePost()
    {
        return $this->hasOne(PostLike::class, 'post_id')->where('user_id', Session::get('user_id'));
    }
    public function PostBookMark()
    {
        return $this->hasOne(PostBookMark::class, 'post_id')->where('user_id', Session::get('user_id'));
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }
    
    public function comments()
    {
        return $this->hasMany(PostComment::class,'post_id');
    }
}
