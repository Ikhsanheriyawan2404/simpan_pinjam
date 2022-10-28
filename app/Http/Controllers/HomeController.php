<?php

namespace App\Http\Controllers;

use App\Models\{Angsuran, User, Pinjaman};

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function profile($id)
    {
        $user = User::find($id);
        // return response()->json(Pinjaman::with('angsuran')->where('user_id', $user->id)->get());
        return view('profile', [
            'user' => $user,
            'angsuran' => Angsuran::with('pinjaman')
                ->whereHas('pinjaman', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->get(),
        ]);
    }
    
}
