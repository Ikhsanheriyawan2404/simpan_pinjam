<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use Illuminate\Support\Facades\Storage;

class AngsuranController extends Controller
{
    public function status(Angsuran $angsuran)
    {
        Angsuran::where('id', $angsuran->id)->update([
            'status' => request('status')
        ]);

        return redirect()->back();
    }

    public function upload(Angsuran $angsuran)
    {
        request()->validate(['bukti_transaksi' => 'required|image|mimes:jpg,jpeg,png']);
        if ($angsuran->bukti_transaksi) {
            Storage::delete($angsuran->bukti_transaksi);
        }
        $image = request()->file('bukti_transaksi')->store('img/bukti_transaksi');

        $angsuran->update([
            'bukti_transaksi' => $image
        ]);

        return redirect()->back();
    }
}
