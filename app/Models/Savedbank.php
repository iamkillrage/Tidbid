<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Savedbank extends Model
{
    use HasFactory;

    protected $table = 'saved_banks';

    protected $fillable = ['influencer_id','id','country','currency','all_stripe_data', 'account_holder_name', 'account_holder_type', 'bank_name', 'account_no', 'routing_no', 'created_at', 'updated_at'];
}
