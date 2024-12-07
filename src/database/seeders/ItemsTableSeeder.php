<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 4,
            'image' => 'images/dummy/ring.png',
            'condition' => '良好',
            'name' => '指輪',
            'explanation' => "カラー：赤\n\n新品\n商品の状態は良好です。傷もありません。\n\n購入後、即発送いたします。",
            'price' => '10000',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id' => 2,
            'image' => 'images/dummy/jacket.png',
            'condition' => '良好',
            'name' => 'ジャケット',
            'explanation' => "カラー：グレー\n\n新品\n商品の状態は良好です。傷もありません。\n\n購入後、即発送いたします。",
            'price' => '7000',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id' => 3,
            'image' => 'images/dummy/hat.png',
            'condition' => '良好',
            'name' => '帽子',
            'explanation' => "カラー：赤\n\n新品\n商品の状態は良好です。傷もありません。\n\n購入後、即発送いたします。",
            'price' => '2000',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id' => 4,
            'image' => 'images/dummy/bag.png',
            'condition' => '良好',
            'name' => 'ショルダーバッグ',
            'explanation' => "カラー：キャメル\n\n新品\n商品の状態は良好です。傷もありません。\n\n購入後、即発送いたします。",
            'price' => '15000',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id' => 1,
            'image' => 'images/dummy/sneakers.png',
            'condition' => '良好',
            'name' => 'スニーカー',
            'explanation' => "カラー：黄色\n\n新品\n商品の状態は良好です。傷もありません。\n\n購入後、即発送いたします。",
            'price' => '5000',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('items')->insert($param);
    }
}
