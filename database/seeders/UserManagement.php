<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserManagement extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_management')->insert([

            'Name'=>'Pardeep Tiwari',
            'Profile_Image'=>'',
            'Email'=>'pradeep@gmail.com',
            'Phone'=>'7975409800',
            'Date_of_Birth'=>'17/03/1991',
            'Sign_up_Date'=>'27/09/2023',
            'Bio'=>'',
            'Following'=>'',
            'Successful_Bids'=>'4',
            'Last_Bid'=>'29/10/2023',
            'Payment_Cards'=>'',
        ]);
    }
}
