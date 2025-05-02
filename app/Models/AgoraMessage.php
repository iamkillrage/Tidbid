<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgoraMessage extends Model
{
    use HasFactory;
    protected $fillable = ['channel_id', 'reciver_id', 'sender_id', 'message', 'message_date_time', 'side'];
}
