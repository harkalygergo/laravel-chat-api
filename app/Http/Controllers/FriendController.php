<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FriendController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('id', '!=', $request->user()->id)
            ->whereNotIn('id', $request->user()->friends->pluck('id'))
            ->whereNotNull('email_verified_at')
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->paginate(10);

        return response()->json($users);
    }

    public function add(Request $request, User $user)
    {
        $authUser = $request->user();

        if (!$user->hasVerifiedEmail()) {
            return response()->json(['message' => 'User not active'], 403);
        }

        $authUser->friends()->syncWithoutDetaching([$user->id]);
        $user->friends()->syncWithoutDetaching([$authUser->id]);

        return response()->json(['message' => 'Friend added']);
    }
}
