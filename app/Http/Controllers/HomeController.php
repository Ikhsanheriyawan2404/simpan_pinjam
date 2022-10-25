<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('profile', [
            'user' => $user,
        ]);
    }
}
