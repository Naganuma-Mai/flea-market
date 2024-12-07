<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'email' => 'taro@example.com',
            'password' => Hash::make('coachtech1001'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('users')->insert($param);
        $param = [
            'email' => 'jiro@example.com',
            'password' => Hash::make('coachtech1002'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('users')->insert($param);
        $param = [
            'email' => 'hanako@example.com',
            'password' => Hash::make('coachtech1003'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('users')->insert($param);
        $param = [
            'email' => 'aiko@example.com',
            'password' => Hash::make('coachtech1004'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('users')->insert($param);
    }
}
