<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Exports\PinjamanExport;
use App\Imports\PinjamanImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

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
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }

        return view('pinjaman.index');
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

    public function import()
    {
        Excel::import(new PinjamanImport, 'pinjaman.xlsx');
        return redirect()->route('pinjaman.index')->with('success', 'All good!');
    }
}
