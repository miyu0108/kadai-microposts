<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $user = User::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、メッセージ編集ビューでそれを表示
        if (\Auth::id() === $user->id) {
            return view('profile.edit', [
                'user' => $user,
            ]);
        }
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:255',
        ]);
        
        // idの値でメッセージを検索して取得
        $user = User::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合はメッセージを更新
        if (\Auth::id() === $user->id) {
            $user->name = $request->name;
            $user->profile_message = $request->profile_message;
            $user->save();
            return redirect($request->redirect_url)
                ->with('success','Update Successful');
        }

        // トップページへリダイレクトさせる
        return redirect('/')
            ->with('Update Failed. You are not authorized to edit.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $user = User::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）であればユーザーを削除
        if (\Auth::id() === $user->id) {
            Auth::logout();
            $user->delete();
        }

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
