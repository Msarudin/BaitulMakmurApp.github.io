<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muzaki extends Model
{
    protected $guarded = ['id'];

    // Pastikan nama fungsi ini sama dengan yang Anda panggil di Blade yaitu 'ktrmustahiqs'
    public function jenis_amal()
    {
        return $this->belongsTo(Jenis_amal::class, 'amal_id');
    } 

    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'bagian_id');
    }
}
