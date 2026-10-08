<?php

namespace App\Exports;

use App\Models\Jamaah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class JamaahExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $rtId;

    // Menerima input ID RT untuk kebutuhan filter data dinamis
    public function __construct($rtId = null)
    {
        $this->rtId = $rtId;
    }

    public function collection()
    {
        $query = Jamaah::query();

        if ($this->rtId) {
            $query->whereHas('bagian', function ($q) {
                $q->where('id', $this->rtId);
            });
        }

        return $query->with('bagian')->get();
    }

    public function headings(): array
    {
        return [
            'Nama Jamaah', 'Email', 'NIK', 'No Kartu Keluarga', 
            'No Tlp', 'Umur', 'Tempat Lahir', 'Tanggal Lahir', 
            'Jenis Kelamin', 'Alamat Sekarang', 'Alamat Asal', 'Bagian RT'
        ];
    }

    public function map($jamaah): array
    {
        return [
            $jamaah->nama_jamaah,
            $jamaah->email,
            $jamaah->nik,
            $jamaah->no_kk,
            $jamaah->no_tlp,
            $jamaah->umur,
            $jamaah->tempat_lahir,
            $jamaah->tanggal_lahir,
            $jamaah->jenis_kelamin,
            $jamaah->alamat_sekarang,
            $jamaah->alamat_asal,
            $jamaah->bagian?->nama_bagian ?? '-',
        ];
    }
}
