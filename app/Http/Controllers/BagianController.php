<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bagian;

class BagianController extends Controller
{
    public function index()
    {
        $bagians = Bagian::all();
        $title = 'Konfirmasi Hapus Data Bagian';
        $text = "Data akan dihapus secera permanen, lanjutkan";
        confirmDelete($title, $text);
        return view('bagian.index', compact('bagians'));
        //$bagians = Bagian::all(); sebelum rubah sweetalet
        //return view('bagian.index', compact('bagians'));
    }
        
    public function show(String $id)
    {
        $bagian = Bagian::find($id);
        return view('bagian.show', compact('bagian'));
    }

    public function destroy(String $id)
    {
        $bagian = Bagian::find($id);
        $bagian->delete();

        //Alert::success('Berhasil', 'Data berhasil dihapus');
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('bagian.index');
    }
}
