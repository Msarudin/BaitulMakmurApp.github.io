<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Jamaah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class IuranController extends Controller
{
    public function index()
    {
        $iuranWarga = Iuran::with(['jamaah.bagian'])->orderBy('tanggal_bayar', 'desc')->get();
        return view('iuran.index', compact('iuranWarga'));
    }

    public function create()
    {
        $daftarJamaah = DB::table('jamaahs')
            ->leftJoin('bagians', 'jamaahs.bagian_id', '=', 'bagians.id')
            ->select('jamaahs.id', 'jamaahs.nama_jamaah', 'bagians.nama_bagian as rt_name')
            ->orderBy('jamaahs.nama_jamaah', 'asc')
            ->get();

        return view('iuran.create', compact('daftarJamaah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jamaah_id' => 'required',
            'tanggal_bayar' => 'required|date',
            'bulan_iuran' => 'required',
            'tahun_iuran' => 'required',
            'nominal' => 'required|numeric',
            'keterangan' => 'nullable|string'
        ]);

        Iuran::create($request->all());
        Alert::success('Berhasil', 'Data berhasil ditambahkan');
        return redirect()->route('iuran-warga.index');
    }

    public function edit($id)
    {
        $iuran = Iuran::findOrFail($id);
        
        $daftarJamaah = DB::table('jamaahs')
            ->leftJoin('bagians', 'jamaahs.bagian_id', '=', 'bagians.id')
            ->select('jamaahs.id', 'jamaahs.nama_jamaah', 'bagians.nama_bagian as rt_name')
            ->orderBy('jamaahs.nama_jamaah', 'asc')
            ->get();

        return view('iuran.edit', compact('iuran', 'daftarJamaah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jamaah_id' => 'required',
            'tanggal_bayar' => 'required|date',
            'bulan_iuran' => 'required',
            'tahun_iuran' => 'required',
            'nominal' => 'required|numeric',
            'keterangan' => 'nullable|string'
        ]);

        $iuran = Iuran::findOrFail($id);
        $iuran->update($request->all());
        Alert::success('Berhasil', 'Data berhasil diedit');
        return redirect()->route('iuran-warga.index');
    }

    public function destroy($id)
    {
        $iuran = Iuran::findOrFail($id);
        $iuran->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('iuran-warga.index');
    }

    // ==================== 📊 FUNGSI EXPORT EXCEL (HTML TO XLS) ====================
    public function exportExcel(Request $request)
    {
        $rt = $request->query('rt');
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');
        
        $query = Iuran::with(['jamaah.bagian']);
        
        if ($rt) {
            $query->whereHas('jamaah.bagian', function($q) use ($rt) {
                $q->where('nama_bagian', str_replace(' ', '_', $rt));
            });
        }
        if ($bulan) {
            $query->where('bulan_iuran', $bulan);
        }
        if ($tahun) {
            $query->where('tahun_iuran', $tahun);
        }
        
        $iuranWarga = $query->get();
        $totalWarga = $iuranWarga->count();
        $totalNominal = $iuranWarga->sum('nominal');

        $namaFile = 'Laporan_Iuran_Warga_' . ($rt ?? 'Semua_RT') . '_' . time() . '.xls';

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$namaFile\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        return view('iuran.pdf', compact('iuranWarga', 'totalWarga', 'totalNominal', 'rt', 'bulan', 'tahun'));
    }

    // ==================== 📄 FUNGSI EXPORT PDF (DOMPDF) ====================
    public function exportPdf(Request $request)
    {
        $rt = $request->query('rt');
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');
        
        $query = Iuran::with(['jamaah.bagian']);
        
        if ($rt) {
            $query->whereHas('jamaah.bagian', function($q) use ($rt) {
                $q->where('nama_bagian', str_replace(' ', '_', $rt));
            });
        }
        if ($bulan) {
            $query->where('bulan_iuran', $bulan);
        }
        if ($tahun) {
            $query->where('tahun_iuran', $tahun);
        }
        
        $iuranWarga = $query->get();
        $totalWarga = $iuranWarga->count();
        $totalNominal = $iuranWarga->sum('nominal');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('iuran.pdf', compact('iuranWarga', 'totalWarga', 'totalNominal', 'rt', 'bulan', 'tahun'));
        
        return $pdf->download('Laporan_Iuran_'.($rt ?? 'Semua_RT').'_'.time().'.pdf');
    }
}
