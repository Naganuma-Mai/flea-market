<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentsTableSeeder extends Seeder
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
            'content' => 'とても着心地がいいです！',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('comments')->insert($param);
        $param = [
            'user_id' => 3,
            'item_id' => 1,
            'content' => '高級感があります！',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('comments')->insert($param);
    }
}
