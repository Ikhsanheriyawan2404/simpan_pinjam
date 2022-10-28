<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Models\{Bunga, Angsuran, Pinjaman};
use App\Exports\{PinjamanExport, PinjamanImport};

class PinjamanController extends Controller
{
    public function index()
    {
        if (request()->ajax()){
            $pinjaman = Pinjaman::latest()->get();
            return DataTables::of($pinjaman)
                ->addIndexColumn()
                ->editColumn('user_id', function (Pinjaman $pinjaman) {
                    return $pinjaman->user->name;
                })
                ->addColumn('status', function ($row) {
                    $tolak = '<form action="'.route('pinjaman.status', $row->id).'" method="post">
                        '.csrf_field().'
                        <input type="hidden" name="status" value="1">
                        <button type="submit" class="btn btn-sm btn-primary">Acc</button>
                    </form>';
                    $acc = '<form action="'.route('pinjaman.status', $row->id).'" method="post">
                        '.csrf_field().'
                        <input type="hidden" name="status" value="0">
                        <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                    </form>';
                    $btn = $row->status == 1 ? 'Diterima' : 'Ditolak';
                    return $row->status == NULL ? "$tolak $acc" : '<button class="btn btn-secondary" disabled>'.$btn.'</button';
                })
                ->addColumn('action', function ($row) {
                    $btn =
                        '<div class="btn-group">
                            <a class="badge bg-navy dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm" id="showDetails">Detail</a>
                                <form action=" ' . route('pinjaman.destroy', $row->id) . '" method="POST">
                                    <button type="submit" class="dropdown-item" onclick="return confirm(\'Apakah yakin ingin menghapus ini?\')">Hapus</button>
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                </form>
                            </div>
                        </div>';
                    return $btn;
                })
                ->rawColumns(['checkbox', 'action', 'status'])
                ->make(true);
        }

        return view('pinjaman.index');
    }

    public function store()
    {
        $totalPinjaman = request('total_pinjaman');
        $tenor = request('tenor');
        $suku_bunga = Bunga::find(1)->suku_bunga;
        $pinjaman = Pinjaman::create([
            'user_id' => auth()->user()->id,
            'total_pinjaman' => $totalPinjaman,
            'saldo_pinjaman' => $totalPinjaman +  $totalPinjaman / $tenor + $totalPinjaman * $suku_bunga / 100 * $tenor,
            'tanggal_pinjam' => date('Y-m-d'),
            'tenor' => $tenor,
            'angsuran_pokok' => $totalPinjaman / $tenor,
            'angsuran_bunga' => $totalPinjaman * $suku_bunga / 100,
            'total_angsuran' => $totalPinjaman / $tenor + $totalPinjaman * $suku_bunga / 100,
            'keterangan' => '-',
            'suku_bunga' => $suku_bunga * $tenor,
        ]);

        for ($i = 0; $i < $tenor; $i++) {
            Angsuran::create([
                'pinjaman_id' => $pinjaman->id,
                'pokok' => $pinjaman->angsuran_pokok,
                'bunga' => $pinjaman->angsuran_bunga,
                'total' => $pinjaman->total_angsuran,
                'tanggal' => date('Y-m-d'),
                'angsuran_keberapa' => $i+1,
            ]);
        }

        return redirect()->back();
    }

    public function show($id)
    {
        $pinjaman = Pinjaman::with('angsuran')->find($id);
        return response()->json($pinjaman);
    }

    public function export()
    {
        return Excel::download(new PinjamanExport, 'pinjaman.xlsx');
    }

    public function status(Pinjaman $pinjaman)
    {
        $pinjaman->update([
            'status' => request('status')
        ]);
        return redirect()->back();
    }

    // public function import()
    // {
    //     Excel::import(new PinjamanImport, 'pinjaman.xlsx');
    //     return redirect()->route('pinjaman.index')->with('success', 'All good!');
    // }
}
