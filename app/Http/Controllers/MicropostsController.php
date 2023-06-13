<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Micropost; 

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザとフォロー中ユーザの投稿の一覧を作成日時の降順で取得
            $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }
        
        // dashboardビューでそれらを表示
        return view('dashboard', $data);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
        ]);
        
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);
        
        // 前のURLへリダイレクトさせる
        return back();
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $micropost = \App\Models\Micropost::findOrFail($id);

        // メッセージ編集ビューでそれを表示
        return view('microposts.edit', [
            'micropost' => $micropost,
        ]);
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
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
        ]);
        
        // idの値でメッセージを検索して取得
        $micropost = \App\Models\Micropost::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合はメッセージを更新
        if (\Auth::id() === $micropost->user_id) {
            $micropost->content = $request->content;
            $micropost->save();
            return redirect($request->redirect_url)
                ->with('success','Update Successful');
        }

        // トップページへリダイレクトさせる
        return redirect('/')
            ->with('Update Failed. You are not authorized to edit.');
    }
    
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $micropost = \App\Models\Micropost::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
            return back()
                ->with('success','Delete Successful');
        }

        // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }
    
    /**
     * 投稿をお気に入りしているユーザー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function favorite_users($id)
    {
        // idの値で投稿を検索して取得
        $micropost = \App\Models\Micropost::findOrFail($id);

        // 関係するモデルの件数をロード
        $micropost->loadRelationshipCounts();

        // 投稿をお気に入りしているユーザー一覧を取得
        $favorite_users = $micropost->favorite_users()->paginate(10);

        // それらを表示
        return view('microposts.favorite_users', [
            'micropost' => $micropost,
            'users' => $favorite_users,
        ]);
    }
    
    public function search(Request $request)       
    {
        // マイクロポスト一覧をページネートで取得
        $microposts = Micropost::orderBy('id', 'desc')->paginate(10);
        
        // 検索フォームで入力された値を取得する
        $search = $request->input('search');
        
        // クエリビルダ
        $query = Micropost::query();
        
        // もし検索フォームにキーワードが入力されたら
        if ($search) {
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search,'s');
            // 単語を半角スペースで区切り、配列にする
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            // 単語をループで回し、マイクロポストと一致するものがあれば、$queryとして保持される
            foreach($wordArraySearched as $value) {
                $query->where('content', 'like', '%'.$value.'%');
            }
            
        // 上記で取得した$queryをページネートにし、変数$usersに代入
        $microposts = $query->paginate(10);
        
        }
        
        // view にmicropostsとsearchを変数として渡す
        return view('microposts.index')
            ->with([
                'microposts' => $microposts,
                'search' => $search,
                ]);
    }
}
