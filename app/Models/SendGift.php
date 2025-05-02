<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendGift extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'gift_amt','stream_id'];


    function getUser(){
        return  $this->belongsTo(User::class,'user_id');
    }
}
