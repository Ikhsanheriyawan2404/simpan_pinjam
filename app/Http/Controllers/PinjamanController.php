<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;

class PinjamanController extends Controller
{
    public function index()
    {
        if (request()->ajax()){
            $Customer = Customer::latest()->get();
            return DataTables::of($Customer)
            ->addIndexColumn()
              ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" name="checkbox" id="check" class="checkbox" data-id="' . $row->id . '">';
                })
                ->addColumn('action', function ($row) {
                    $btn =
                        '<div class="btn-group">
                            <a class="badge bg-navy dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm" id="editCustomer">Edit</a>
                                <form action=" ' . route('customers.destroy', $row->id) . '" method="POST">
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
}
