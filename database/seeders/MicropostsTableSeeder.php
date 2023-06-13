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
        $user_num = 30;
        $post_num_max = 20;
        $follow_num_max = 10;
        $favorite_num_max = 15;
        $content = [
            'お腹すいた。', 
            '眠い。',
            '今日も頑張るぞ！', 
            'お疲れ様。',
            'Apexする人募集！',
            'スプラトゥーンする人募集！',
            '一緒にスシロー行く人募集！',
            'パブロ・ディエゴ・ホセ・フランシスコ・デ・パウラ・ホアン・ネポムセーノ･マリーア・デ・ロス・レメディオス・クリスピン・クリスピアーノ・デ・ラ・サンディシマ・トリニダード･ルイス・イ・ピカソ'
        ];
        
        for($i = 1; $i <= $user_num; $i++) {
            // ユーザーを作成
            DB::table('users')->insert([
                'name' => 'test name ' . $i,
                'email' => 'test' . $i . '@co.jp',
                'password' => Hash::make('password')
            ]);
            
            // ランダムにpostを作成
            for ($j = 1; $j <= rand(1,$post_num_max); $j++) {
                DB::table('microposts')->insert([
                    'user_id' => $i,
                    'content' => $content[rand(0, count($content) - 1)],
                    'created_at' => '2023' . '/' . '06' . '/' . rand(1, 30) . ' ' . rand(0, 23) . ':' .  rand(0, 59) . ':' . rand(0, 59)
                ]);
            }
        }
        
        $micropost_num = DB::table('microposts')->count();
        for($i = 1; $i <= $user_num; $i++) {   
            // ランダムにお気に入りする
            $favorite_num = rand(0, $favorite_num_max);
            $array = range(1, $micropost_num);
            print 'user_id: '.$i.'のお気に入り数は' . $favorite_num . PHP_EOL;
            shuffle($array);
            for ($h = 0; $h<=$favorite_num ; $h++)
                DB::table('favorites')->insert([
                    'user_id' => $i,
                    'micropost_id' => $array[$h]
                ]);
            
            
            // ランダムにフォローする
            $array = range(1, $user_num);
            shuffle($array);
            for ($k = 0; $k <= rand(0,$follow_num_max); $k++) {
                DB::table('user_follow')->insert([
                    'user_id' => $i,
                    'follow_id' => $array[$k]
                ]);
            }
        }
    }
}
