<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\str;
use App\Models\Tweet;
use App\Models\Image;

class TweetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('tweets')->insert([
        //     'user_id' => 
        //     'tweet' => Str::random(10),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // TweetFactoryからデータを10件作成し，ImageFactoryから4件データを生成する．
        // 生成したtweetsレコードのデータからTweetsモデルにより，Pivotモデルを経由してattachでImageIdを紐づけて交差テーブルに保存
        // このデータでは10件のつぶやきレコードと，そのつぶやきにそれぞれ4件の画像が紐づくようになる．
        Tweet::factory()->count(10)->create()->each(fn($tweet) =>
            Image::factory()->count(4)->create()->each(fn($image) =>
                $tweet->images()->attach($image->id)
            )
        );

    }
}
