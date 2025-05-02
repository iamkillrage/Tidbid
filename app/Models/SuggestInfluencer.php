<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestInfluencer extends Model
{
    use HasFactory;
    protected $fillable = ['influencer_id', 'suggest_influencer_id'];
    public function user(){
        return $this->belongsTo(User::class,'suggest_influencer_id');
    }
}
