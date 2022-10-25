<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;

class PinjamanController extends Controller
{
    public function index()
    {
        $data = Pinjaman::all();
        return view('pinjaman.index', compact('data'));
    }

    public function show($id)
    {
        $pinjaman = Pinjaman::with('angsuran')->find($id);
        return response()->json($pinjaman);
    }
}
