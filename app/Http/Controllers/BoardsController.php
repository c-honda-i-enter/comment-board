<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

use Illuminate\Support\Facades\DB;

class BoardsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            
            $boards = DB::table('board')
                    ->join('users', 'board.user_number', '=', 'users.id')
                    ->where('board.delete_flag', 0)
                    ->select('board.*', 'users.user_name')
                    ->orderBy('board.created_at', 'desc')
                    ->paginate(5);
            // $boards = $user->boards()->where('delete_flag', 0)->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'boards' => $boards,
            ];
        }
        
        return view('dashboard', $data);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|max:280',],
            [
                'message.required' => 'メッセージを入力してください', 
                'message.max' => '※140文字以内で入力してください',
            ]);
            
        try {
            $request->user()->boards()->create([
                'message' => $request->message,
            ]);
            
            session()->flash('flash_message_success', '投稿しました！');
        }
        
        catch(\Exception $e) {
            $e->getMessage();
            
            session()->flash('flash_message_error', '投稿失敗しました');
        }
        
        return redirect('/');
    }
    
    public function destroy(string $message_id)
    {
        $board = Board::where('message_id', $message_id)->firstOrFail();
        
        if (\Auth::id() === $board->user_number) {
            $board->delete_flag = 1;
            $board->save();
            return back()
                ->with('success','Delete Successful');
        }
        
        return back()
            ->with('error', 'Delete Failed');
    }
            
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        $user->loadRelationshipCounts();
        
        $boards = $user->boards()->orderBy('created_at', 'desc')->paginate(10);
        
        return view('users.show', [
            'user' => $user,
            'boards' => $boards
        ]);
    }
}
