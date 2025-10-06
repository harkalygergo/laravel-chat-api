<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }
}
