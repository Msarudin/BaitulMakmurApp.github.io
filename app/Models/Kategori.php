<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['name', 'slug'];
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'kategori_id');
    }
}
