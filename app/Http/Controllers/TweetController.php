<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\Tweet;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tweets = Tweet::getAllOrderByUpdated_at();
        return view('tweet.index', compact('tweets')); // tweet.indexはtweetフォルダのindex.blade.phpの意味
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tweet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //　バリデーション
        $validator = Validator::make($request->all(), [
            'tweet' => 'required | max:191', 
            'description' => 'required',
        ]);
        // バリデーション：エラー
        if ($validator->fails()) {
            return redirect()
                ->route('tweet.create')
                ->withInput()
                ->withErrors($validator);
        }
        // create()は最初から用意されている関数
        // 戻り値は挿入されたレコードの情報
        $result = Tweet::create($request->all());
        // ddd($result);
        // ルーティング"todo.index"にリクエスト送信（一覧ページに移動）
        return redirect()->route('tweet.index');
        // 'tweet.index'はルーティング表を確認！！
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ddd($id);
        // idを指定して1件のデータを取得したい
        $tweet = Tweet::find($id);
        return view('tweet.show', compact('tweet'));
        // ここでは受け取ったidの値でテーブルからデータを取り出し，tweetという名前でshow.blade.phpに渡している．
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 編集画面に移動する処理
        $tweet = Tweet::find($id);
        return view('tweet.edit', compact('tweet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 指定したデータを更新する処理の作成
        // バリデーション
        $validator = Validator::make($request->all(), [
            'tweet' => 'required | max:191',
            'description' => 'required',
        ]);
        // バリデーション：エラー
        if ($validator->fails()) {
            return redirect()
                ->route('tweet.edit', $id)
                ->withInput()
                -withErrors($validator);
        }
        // データ更新処理
        $result = Tweet::find($id)->update($request->all());
        // ddd($result);
        return redirect()->route('tweet.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // まずidで指定したデータを1件抽出し，そのデータを削除するという流れ．
        $result = Tweet::find($id)->delete();
        // 削除した後，一覧画面に戻るようにルーティング
        return redirect()->route('tweet.index');
    }
}
