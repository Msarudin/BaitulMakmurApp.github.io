<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    protected $table = 'iuran';
    protected $fillable = ['jamaah_id', 'tanggal_bayar', 'bulan_iuran', 'tahun_iuran', 'nominal', 'keterangan'];

    // LOGIKA PENGAMBILAN DATA JAMAAH
    public function jamaah()
    {
        return $this->belongsTo(Jamaah::class, 'jamaah_id');
    }
}
