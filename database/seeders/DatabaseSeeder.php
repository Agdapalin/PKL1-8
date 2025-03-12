<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Array of teacher data
        $teachers = [
            [
                'name' => 'Test User 1',
                'email' => 'test1@example.com',
                'phone' => '0812123447',
                'jabatan' => 'kepala sekolah',
                'addres' => 'lampung',
                'gender' => 'male',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Test User 2',
                'email' => 'test2@example.com',
                'phone' => '0812123448',
                'jabatan' => 'guru',
                'addres' => 'jakarta',
                'gender' => 'female',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Test User 3',
                'email' => 'test3@example.com',
                'phone' => '0812123449',
                'jabatan' => 'staff',
                'addres' => 'bandung',
                'gender' => 'male',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more teachers as needed
        ];

        // Insert each teacher into the database
        foreach ($teachers as $teacher) {
            DB::table('teacher')->insert($teacher);
        }

        $this->call([
            StudentSeeder::class,
            TeacherSeeder::class,
        ]);
    }
}