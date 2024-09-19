<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Md. Asaduzzaman',
            'email' => '123mdasaduzzaman@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
        ]);
    }
}
