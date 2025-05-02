<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ReferFriend extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('refer_friends')->insert([

            'name'=>'Waseem Khan',
            'email'=>'Waseem@gmail.com',
            'phone'=>'9989987004',
            'date_of_refer'=>'	19/05/2022',
            'time_of_refer'=>'11:30 AM',
            'refer_to'=>'Jenny Wilson, Albert Flores, Albert Flores',
            'earned_reward'=>'10$',
        ]);
       
       
    }
}
