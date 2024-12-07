<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'item_id' => 2,
            'payment_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('purchases')->insert($param);
        $param = [
            'user_id' => 2,
            'item_id' => 5,
            'payment_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('purchases')->insert($param);
        $param = [
            'user_id' => 3,
            'item_id' => 1,
            'payment_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('purchases')->insert($param);
        $param = [
            'user_id' => 4,
            'item_id' => 3,
            'payment_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('purchases')->insert($param);
    }
}
