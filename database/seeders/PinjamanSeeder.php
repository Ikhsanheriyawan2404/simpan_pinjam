<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Bunga;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Database\Seeder;

class PinjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $totalPinjaman = 1000000;
        $tenor = 6;
        $suku_bunga = Bunga::find(1)->suku_bunga;
        $pinjaman = Pinjaman::create([
            'user_id' => 1,
            'total_pinjaman' => $totalPinjaman,
            'saldo_pinjaman' => $totalPinjaman + $totalPinjaman * $suku_bunga / 100 * $tenor,
            'tanggal_pinjam' => '2022-07-19',
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
                'jatuh_tempo' => Carbon::parse($pinjaman->tanggal_pinjam)->addMonth($i+1)->format('Y-m-d'),
                'angsuran_keberapa' => $i+1,
            ]);
        }
    }
}
