<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefferedInfu extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'refered_user_id'];

    public function referredByUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function referredByToUser()
    {
        return $this->belongsTo(User::class, 'refered_user_id', 'id');
    }
    
}
