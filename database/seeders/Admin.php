<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\HASH;
class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('Admins')->insert([
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('12345'),
        ]);
    }
}
