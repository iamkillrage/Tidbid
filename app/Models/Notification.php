<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'influencer_id',
        'title',
        'message',
        'seen_status',
        'created_at',
        'updated_at',
    ];
}
