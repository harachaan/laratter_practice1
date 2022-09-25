<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    // アプリケーション側でcreateなどできない値を記述する．
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
    
    // 更新日時が新しい順にソートする
    public static function getAllOrderByUpdated_at()
    {
        return self::orderBy('updated_at', 'desc')->get(); // descは降順を表す．
    }
    // Tweet対User（多対１）のリレーションを作る
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // 多対多にする
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    // Tweetモデルから交差テーブルを利用したImageモデルとの紐付きを定義した．
    // これで多対多の関係でTweetImageのpivotモデルを経由してImageモデルが取得できるようになる．
    // ORMとしてデータベースのテーブル定義をそのまま反映しているので，多対多の関係となっているが，実際はImageが複数のTweetを持つことはないので，実質1対多として扱う．
    public function images()
    {
        return $this->belongsToMany(Image::class, 'tweet_image')->using(TweetImage::class);
    }
}
