<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'email' => 'admin@example.com',
            'password' => Hash::make('coachtech2001'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('admins')->insert($param);
    }
}
