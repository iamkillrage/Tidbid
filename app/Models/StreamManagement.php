<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StreamManagement extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    public function getInfluencer()
    {
        return $this->belongsTo(User::class, 'influencer_id')->where('role', 'Influencer')->withTrashed()->with('followerscount', 'upcomingstreamcount');;
    }

    protected $fillable = [
        'influencer_id',
        'streamTitle',
        'streamDate',
        'streamTime',
        'baseBidPrice',
        'what_to_expect',
        'term_and_conditions',
        'description',
        'thumbnail_img',
        'location',
        'event_status',
        'streamDateTime',
        'bid_end_status'
    ];
    public function getInfluencers()
    {
        return $this->belongsTo(User::class, 'influencer_id')->where('role', 'Influencer');
    }

    public function notify()
    {
        return $this->hasOne(Notify::class, 'stream_id');
    }



    public function scopeFilter($query, $search)
    {
        if (isset($search->datefilter)) {
            $search_date =  explode("-", $search->datefilter);
            $date1 = date('Y-m-d', strtotime($search_date[0]));
            $date2 = date('Y-m-d', strtotime($search_date[1] . ' +1 day'));
            $query->whereBetween('created_at', [$date1, $date2]);
        }
        return $query;
    }
}
