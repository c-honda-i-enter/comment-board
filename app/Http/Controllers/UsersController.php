<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller
{
    public function index()
    {
        
    }
    
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        
        $user->loadRelationshipCounts();
        
        $boards = $user->boards()->orderBy('created_at', 'desc')->paginate(10);

        return view('users.show', [
            'user' => $user,
            'boards' => $boards,
        ]);
    }
    
    public function favorites($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのお気に入り一覧を取得
        $favorites = $user->favorites()->orderBy('created_at', 'desc')->paginate(10);

        // お気に入り一覧ビューでそれらを表示
        return view('users.favorites', [
            'user' => $user,
            'favorites' => $favorites,
        ]);
    }
}
