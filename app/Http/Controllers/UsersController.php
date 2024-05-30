<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



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
}
