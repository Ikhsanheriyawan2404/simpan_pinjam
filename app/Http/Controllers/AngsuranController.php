<?php

namespace App\Http\Controllers;

use Exception;
use App\Exports\PinjamanExport;
use Illuminate\Support\Facades\DB;
use App\Models\{Angsuran, Pinjaman};
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class AngsuranController extends Controller
{
    public function status(Angsuran $angsuran)
    {
        try {
            DB::transaction(function () use ($angsuran) {
                Angsuran::where('id', $angsuran->id)->update([
                    'status' => request('status')
                ]);
                if (request('status') == 1) {
                    Pinjaman::where('id', $angsuran->pinjaman_id)->update([
                        'saldo_pinjaman' => DB::raw("saldo_pinjaman - $angsuran->total")
                    ]);
                } else if (request('status') == 0) {
                    Pinjaman::where('id', $angsuran->pinjaman_id)->update([
                        'saldo_pinjaman' => DB::raw("saldo_pinjaman + $angsuran->total")
                    ]);
                }
            });
        } catch (Exception $e) {
            $e->getMessage();
        }

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

    public function export(Pinjaman $pinjaman)
    {
        return Excel::download(new PinjamanExport($pinjaman->id), 'pinjaman.xlsx');
    }
}
