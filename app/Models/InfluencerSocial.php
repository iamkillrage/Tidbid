<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluencerSocial extends Model
{
    use HasFactory;
    protected $fillable = ['social_site_link','user_id'];
}
