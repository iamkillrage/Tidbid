<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostManagement extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        DB::table('post_management')->insert([

            'Influencer_Name'=>'Sophia Garcia',
            'Post_Title'=>'Blog',
            'Date_of_Post'=>'14/10/2021',
            'Time_of_Post'=>'12:30 PM',
            'Picture_Posted'=>'',
            'Likes'=>'',
            'Comments'=>'',
        ]);
    }
}
