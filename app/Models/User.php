<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'userName',
        'password',
        'bio',
        'role',
        'phone',
        'dob',
        'otp',
        'profile_img',
        'referral_code',
        'agree',
        'customer_id',
        'profile_status',
        'verify_status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function streams(){
        return $this->hasMany(StreamManagement::class,'influencer_id','id');
    }

    public function posts(){
        return $this->hasMany(Post::class,'influencer_id','id');
    }

    public function scopeFilter($query,$search ){
        if(isset($search->datefilter)){
            $search_date =  explode("-", $search->datefilter);
            $date1 = date('Y-m-d', strtotime($search_date[0]));
            $date2 = date('Y-m-d', strtotime($search_date[1] . ' +1 day'));
            $query->whereBetween('created_at', [$date1, $date2]);
        }
        return $query;
    }

    public function upcomingStreams(){
    $currentDate = date('Y-m-d H:i:s');
    return $this->hasMany(StreamManagement::class,'influencer_id')->where('streamDate', '>', $currentDate);
}
public function getFollowing(){
    return  $this->hasMany(Follower::class,'user_id');
}

public function verifications()
{
    return $this->hasOne(InfluencerIdVerification::class,'user_id');
}

public function postLikes()
{
    return $this->hasMany(PostLike::class);
}

public function followerscount(){
    return $this->hasMany(Follower::class,'following_id','id');
}

public function upcomingstreamcount(){
    $currentDate = date('Y-m-d');
    return $this->hasMany(StreamManagement::class,'influencer_id','id')->where('streamDate', '>=', $currentDate);
}


public function social_links()
{
    return $this->hasMany(InfluencerSocial::class, 'user_id');
}


}

