<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bid extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'infulencer_id', 'stream_id', 'bid_price', 'bid_date', 'status'];
    
    public function getInfluencer()
    {
        return $this->belongsTo(User::class, 'infulencer_id')->where('role', 'Influencer')->withTrashed();
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id')->where('role', 'User')->withTrashed();
    }

    public function getStream()
    {
        return $this->belongsTo(StreamManagement::class, 'stream_id')->withTrashed();
    }
}
