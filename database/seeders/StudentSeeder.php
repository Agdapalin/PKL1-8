<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('students')->insert([
            'name'=>'tri',
            'email'=>'susi.com',
            'phone'=>'0854657679',
            'class'=>'12',
            'image'=>'1.jpg',
            'addres'=>'lampung',
            'gender'=>'female',
            'status'=>'active',
            'created_at'=>now(),
            'updated_at'=>now(),

        ]);
    }
}
