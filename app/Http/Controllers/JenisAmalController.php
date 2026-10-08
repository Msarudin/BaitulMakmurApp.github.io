<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis_amal;

class JenisAmalController extends Controller
{
    public function index()
    {
        $jenis_amal = Jenis_amal::all();
        return view('jenis_amal.index', compact('jenis_amal'));
    }
}
