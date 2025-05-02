<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StreamManagement extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stream_management')->insert([

            'Influencer_Name'=>'Kesha Scott',
            'Stream_Title'=>'Nws',
            'Date_of_Stream'=>'28/06/2023',
            'Time_of_Stream'=>'8:30 PM',
            'About_Stream'=>'',
            'Base_Bid_Price'=>'5k',
            'Current_Bid'=>'19k',
            'Gift_Received'=>'',
            'Status'=>'',
        ]);  
    }
}
