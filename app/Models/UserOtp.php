<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOtp extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'otp', 'otp_date_time',  'created_at', 'updated_at', 'deleted_at'];
}
