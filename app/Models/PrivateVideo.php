<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateVideo extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'stream_id', 'join_url'];
}
