<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicropostsController extends Controller
{
     public function index()
    {
       $data = [];
        if (\Auth::check()) {
            // 認証済みユーザ（閲覧者）を取得
            $user = \Auth::user();
            // ユーザとフォロー中ユーザの投稿の一覧を作成日時の降順で取得
            $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    }
     public function store(Request $request)
    {
        
        $request->validate([
            'content' => 'required|max:255',
        ]);

      
        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);

     
        return back();
    }
     public function destroy($id)
    {
  
        $micropost = \App\Micropost::findOrFail($id);

      
        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
        }

     
        return back();
    }
}
