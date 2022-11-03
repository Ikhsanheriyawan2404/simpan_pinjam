<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\{Bunga, Angsuran, Pinjaman};

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
                ->editColumn('saldo_pinjaman', function (Pinjaman $pinjaman) {
                    return $pinjaman->saldo_pinjaman <= 0 ? 0 : $pinjaman->saldo_pinjaman;
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
                                <a class="dropdown-item" href="' . route('angsuran.export', $row->id) . '" class="btn btn-primary btn-sm">Export</a>
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
        request()->validate([
            'total_pinjaman' => 'required',
            'tenor' => 'required',
        ]);
        try {
            DB::transaction(function () {
                $totalPinjaman = request('total_pinjaman');
                $tenor = request('tenor');
                $suku_bunga = Bunga::find(1)->suku_bunga;
                $pinjaman = Pinjaman::create([
                    'user_id' => auth()->user()->id,
                    'total_pinjaman' => $totalPinjaman,
                    'saldo_pinjaman' => $totalPinjaman + $totalPinjaman * $suku_bunga / 100 * $tenor,
                    'tenor' => $tenor,
                    // 'tanggal_pinjam' => date('Y-m-d'),
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
                        'jatuh_tempo' => Carbon::parse($pinjaman->tanggal_pinjam)->addMonth($i+1)->format('Y-m-d'),
                        'angsuran_keberapa' => $i+1,
                    ]);
                }
            });
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }

        return redirect()->back();
    }

    public function show($id)
    {
        $pinjaman = Pinjaman::with('angsuran')->find($id);
        return response()->json($pinjaman);
    }

    public function status(Pinjaman $pinjaman)
    {
        $pinjaman->update([
            'status' => request('status'),
            'tanggal_pinjam' => date('Y-m-d'),
        ]);
        return redirect()->back();
    }
}
