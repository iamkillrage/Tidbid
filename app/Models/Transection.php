<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'influencer_id', 'stream_id', 'date_time', 'amount'];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id')->where('role', 'User')->withTrashed(); 
    }

    public function getStream(){
        return $this->belongsTo(StreamManagement::class,'stream_id')->withTrashed();
    }

    public function getInfu(){
        return $this->belongsTo(User::class, 'influencer_id')->withTrashed(); 
    }
}
