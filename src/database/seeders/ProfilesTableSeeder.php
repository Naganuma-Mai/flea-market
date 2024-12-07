<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProfilesTableSeeder extends Seeder
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
            'image' => 'images/dummy/man1.jpg',
            'name' => '山田太郎',
            'postal_code' => '163-8001',
            'address' => '東京都新宿区西新宿2-8-1',
            'building' => 'サンハイツ201',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('profiles')->insert($param);
        $param = [
            'user_id' => 2,
            'image' => 'images/dummy/man2.jpg',
            'name' => '山田次郎',
            'postal_code' => '320-8501',
            'address' => '栃木県宇都宮市塙田1-1-20',
            'building' => 'リバーサイド303',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('profiles')->insert($param);
        $param = [
            'user_id' => 3,
            'image' => 'images/dummy/woman1.jpg',
            'name' => '山田花子',
            'postal_code' => '330-9301',
            'address' => '埼玉県さいたま市浦和区高砂3-15-1',
            'building' => 'グリーンハイツ505',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('profiles')->insert($param);
        $param = [
            'user_id' => 4,
            'image' => 'images/dummy/woman2.jpg',
            'name' => '山田愛子',
            'postal_code' => '920-8580',
            'address' => '石川県金沢市鞍月1丁目1番地',
            'building' => 'ビューティーガーデン203',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('profiles')->insert($param);
    }
}
