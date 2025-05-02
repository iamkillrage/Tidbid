<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class InfluencerManagement extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('influencer_management')->insert([

            'Influencer_Name'=>'Pardeep Tiwari',
            'Socials'=>'',
            'Profile_Pic'=>'',
            'Email'=>'pradeep@gmail.com',
            'Phone'=>'7975409800',
            'Date_of_Birth'=>'17/03/1991',
            'Sign_up_Date'=>'27/09/2023',
            'Bio'=>'',
            'Following'=>'',
            'Followers'=>'',
            'Upcoming_Stream'=>'12/02/2024',
            'Total_Streams'=>'4',
        ]);
    }
}
