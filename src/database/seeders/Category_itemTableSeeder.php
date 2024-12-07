<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Category_itemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'item_id' => 1,
            'category_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('category_item')->insert($param);
        $param = [
            'item_id' => 1,
            'category_id' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('category_item')->insert($param);
        $param = [
            'item_id' => 2,
            'category_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('category_item')->insert($param);
        $param = [
            'item_id' => 2,
            'category_id' => 6,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('category_item')->insert($param);
        $param = [
            'item_id' => 3,
            'category_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('category_item')->insert($param);
        $param = [
            'item_id' => 3,
            'category_id' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('category_item')->insert($param);
        $param = [
            'item_id' => 4,
            'category_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('category_item')->insert($param);
        $param = [
            'item_id' => 4,
            'category_id' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('category_item')->insert($param);
        $param = [
            'item_id' => 5,
            'category_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('category_item')->insert($param);
        $param = [
            'item_id' => 5,
            'category_id' => 6,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('category_item')->insert($param);
    }
}
