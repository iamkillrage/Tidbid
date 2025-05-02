<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgoraChat extends Model
{
    use HasFactory;
    protected $fillable = ['sender_id', 'reciver_id', 'chanel_name'];

    public function getInfuList()
    {
        return $this->belongsTo(User::class, 'reciver_id');
    }

    public function getsender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function getUserLastMessage()
    {
        return $this->hasOne(AgoraMessage::class, 'sender_id', 'sender_id')->latest();;
    }

    public function getInfuLastMessage()
    {
        return $this->hasOne(AgoraMessage::class, 'reciver_id', 'sender_id')->latest();;
    }
}
