<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidManagement extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bid_management')->insert([

            'Influencer_Name'=>'Robin Williams',
            'Title_of_Stream'=>'News',
            'Date_of_Stream'=>'17/10/2022',
            'Time_of_Stream'=>'6:30 PM',
            'About_Stream'=>'',
            'Base_Bid_Price'=>'4k',
            'Win_Bid_Price'=>'10k',
            'Winner'=>'Kathryn Murphy',
            'Results'=>'Very Good',
        ]);
    }
}
