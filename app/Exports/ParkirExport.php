<?php

namespace App\Exports;

use App\Models\Parkir;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParkirExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $parkir = Parkir::with('parkirKeluar')->where('status', 1)->get();
        return $parkir;
    }

    public function map($parkir): array
    {
        return [
            [
                $parkir->kode_parkir,
                $parkir->no_polisi,
                $parkir->merk,
                $parkir->tgl_masuk,
                $parkir->time_masuk,
                $parkir->parkirKeluar->tgl_keluar,
                $parkir->parkirKeluar->time_keluar,
                $parkir->parkirKeluar->tarif,
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'Kode Parkir',
            'No Polisi',
            'Merk Kendaraan',
            'Tanggal Masuk',
            'Waktu Masuk',
            'Tanggal Keluar',
            'Waktu Keluar',
            'Tarif',
        ];
    }
}
