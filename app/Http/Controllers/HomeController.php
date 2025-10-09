<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $newUsers = User::orderByDesc('created_at')
            ->limit(10)
            ->get(['id', 'name', 'email', 'created_at']);

        $activeUsers = User::whereNotNull('email_verified_at')
            ->orderByDesc('email_verified_at')
            ->limit(10)
            ->get(['id', 'name', 'email', 'email_verified_at']);

        $latestFriendships = DB::table('friendships')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get(['user_id', 'friend_id', 'created_at']);

        $latestMessages = Message::with(['sender:id,name', 'receiver:id,name'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get(['id', 'sender_id', 'receiver_id', 'content', 'created_at']);

        return view('home', compact(
            'newUsers',
            'activeUsers',
            'latestFriendships',
            'latestMessages'
        ));
    }
}
