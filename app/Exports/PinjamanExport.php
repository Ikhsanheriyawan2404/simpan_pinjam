<?php

namespace App\Exports;

use App\Models\Angsuran;
use Maatwebsite\Excel\Concerns\FromCollection;

class PinjamanExport implements FromCollection
{
    protected $id;

    public function construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Angsuran::all();
    }
}
