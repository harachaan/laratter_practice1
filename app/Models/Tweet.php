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
}
