<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Html\Editor\Fields\BelongsTo;

class Pinjaman extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'pinjaman';
    protected $appends = ['angsuran', 'arrears'];

    public function getArrearsAttribute()
    {
        return Angsuran::where('pinjaman_id', $this->id)
            ->where('status', '0')
            ->where('jatuh_tempo', '<', \Carbon\Carbon::now())
            ->sum('total');
    }

    public function angsuran()
    {
        return $this->hasMany(Angsuran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAngsuranAttribute()
    {
        return $this->total_pinjaman / $this->tenor * Bunga::find(1)->suku_bunga / 100;
    }

}
