<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('teacher')->insert([
            'name'=>'mutiara',
            'email'=>'muti.com',
            'phone'=>'08546787579',
            'jabatan'=>'staff',
            'addres'=>'lampung',
            'gender'=>'female',
            'status'=>'active',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
