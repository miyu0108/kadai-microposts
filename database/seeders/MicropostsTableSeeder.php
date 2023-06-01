<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MicropostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 15; $i++) {
            DB::table('users')->insert([
                'name' => 'test name ' . $i,
                'email' => 'test' . $i . '@co.jp',
                'password' => Hash::make('password')
            ]);
            DB::table('microposts')->insert([
                'user_id' => $i,
                'content' => 'test message' . $i,
            ]);
            DB::table('microposts')->insert([
                'user_id' => $i,
                'content' => 'test message log version wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww' . $i
            ]);
        }
    }
}
