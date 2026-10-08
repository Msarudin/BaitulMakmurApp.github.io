<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mustahiq extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Pastikan nama fungsi ini sama dengan yang Anda panggil di Blade yaitu 'ktrmustahiqs'
    public function ktrmustahiqs()
    {
        return $this->belongsTo(Ktrmustahiq::class, 'ktrmustahiq_id');
    } 

    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'bagian_id');
    }
}
