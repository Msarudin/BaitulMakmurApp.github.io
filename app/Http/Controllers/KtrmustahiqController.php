<?php

namespace App\Http\Controllers;

use App\Models\Ktrmustahiq;
use Illuminate\Http\Request;

class KtrmustahiqController extends Controller
{
    public function index()
    {
        $ktrmustahiqs = Ktrmustahiq::all();
        return view('krtmustahiq.index', compact('ktrmustahiqs'));
    }
}
