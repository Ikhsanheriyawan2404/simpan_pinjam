<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'angsuran';

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class);
    }

    public function getTakeImageAttribute()
    {
        return '/storage/' . $this->bukti_transaksi;
    }
}
