<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use App\Models\Tweet;
// use App\Models\Image;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([TweetsSeeder::class]);

        // // TweetFactoryからデータを10件作成し，ImageFactoryから4件データを生成する．
        // // 生成したtweetsレコードのデータからTweetsモデルにより，Pivotモデルを経由してattachでImageIdを紐づけて交差テーブルに保存
        // // このデータでは10件のつぶやきレコードと，そのつぶやきにそれぞれ4件の画像が紐づくようになる．
        // Tweet::factory()->count(10)->create()->each(fn($tweet) =>
        //     Image::factory()->count(4)->create()->each(fn($image) =>
        //         $tweet->images()->attach($image->id)
        //     )
        // );


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
