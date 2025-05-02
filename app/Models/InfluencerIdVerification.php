<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluencerIdVerification extends Model
{
    use HasFactory;
    protected $fillable = ['verificationPlatform', 'verificationDate', 'status','user_id'];

    public function getInfluencer()
    {
        return $this->belongsTo(User::class, 'user_id')->where('role', 'Influencer')->withTrashed();;
    }
}
