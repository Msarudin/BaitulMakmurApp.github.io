<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    public function jamaah()
    {
        return $this->hasMany(Jamaah::class);
    }
}
