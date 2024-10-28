<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '洋服',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => '帽子',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'バッグ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => '靴',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'アクセサリー',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'メンズ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'レディース',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('categories')->insert($param);
    }
}
