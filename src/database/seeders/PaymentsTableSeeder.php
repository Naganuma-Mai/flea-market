<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'クレジットカード',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('payments')->insert($param);
        $param = [
            'name' => 'コンビニ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('payments')->insert($param);
        $param = [
            'name' => '銀行振込',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('payments')->insert($param);
    }
}
