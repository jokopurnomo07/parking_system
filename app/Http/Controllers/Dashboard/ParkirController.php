<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParkirMasukRequest;
use App\Models\Parkir;
use App\Models\ParkirKeluar;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class ParkirController extends Controller
{
    public function parkirMasuk(ParkirMasukRequest $request)
    {

        $kode_parkir = \Str::random(6);
        $checkKodeParkir = Parkir::where('kode_parkir', $kode_parkir)->first();
        while ($checkKodeParkir) {
            $kode_parkir = \Str::random(6);
            $checkKodeParkir = Parkir::where('kode_parkir', $kode_parkir)->first();
        }

        $data = Parkir::create([
            'kode_parkir' => $kode_parkir,
            'no_polisi' => $request->no_polisi,
            'merk' => $request->merk_kendaraan,
            'tgl_masuk' => Carbon::now()->format('Y-m-d'),
            'time_masuk' => Carbon::now()->format('H:i:m'),
            'status' => 0,
        ]);

        return redirect()->back()->with('success', 'Berhasil Parkir');
    }

    public function parkirKeluar(Request $request)
    {

        $data = Parkir::where('kode_parkir', $request->kode_parkir)->first();

        // Check berapa jam mobil parkir
        $tgl1 = new DateTime($data->tgl_masuk . $data->time_masuk);
        $tgl2 = new DateTime(Carbon::now()->format('Y-m-d') . Carbon::now()->format('H:i:m'));
        $jarak = $tgl2->diff($tgl1);

        $tarifParkir = 0;
        if ($jarak->h <= 1) $tarifParkir = 1500;
        if ($jarak->h >= 1) $tarifParkir = $jarak->h * 3000;
        if( $jarak->i <= 59 && $jarak->h >= 1 ) $tarifParkir = ($jarak->h * 3000) + 1500;

        $parkirKeluar = ParkirKeluar::create([
            'parkir_id' => $data->id,
            'tarif' => $tarifParkir,
            'tgl_keluar' => Carbon::now()->format('Y-m-d'),
            'time_keluar' => Carbon::now()->format('H:i:m'),
        ]);

        $updateStatus = Parkir::where('id', $data->id)->update(['status' => 1]);

        return redirect()->back()->with([
            'modal' => true,
            'data' => $data,
            'tarif' => $tarifParkir,
        ]);

    }
}
