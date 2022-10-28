<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;

class AngsuranController extends Controller
{
    public function index()
    {
        Angsuran::where('id', request('angsuran_id'))->update([
            'status' => 1
        ]);

        return redirect()->back();
    }
}
