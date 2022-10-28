<?php

namespace App\Imports;

use App\Models\Pinjaman;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PinjamanImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            $classroom = Classroom::where('name', $row[4])->first();
            $student = Student::create([
                'name' => $row[0],
                'nisn' => $row[1],
                'gender' => $row[2],
                'religion' => $row[3],
                'classroom_id' => $classroom->id,
                'date_of_birth' => $row[5],
                'phone' => $row[6],
                'email' => $row[7],
                'address' => $row[8],
            ]);
        }
    }
}
