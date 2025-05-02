<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class VarificationManagement extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('varification_management')->insert([

            'Influencer_Name'=>'Pardeep Tiwari',
            'Verification_Date'=>'16/01/2023',
            'Verification_Platform'=>'',
            'View_Verification'=>'',
          
        ]);
    }
}

