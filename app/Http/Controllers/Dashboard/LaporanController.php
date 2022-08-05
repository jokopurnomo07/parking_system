<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ParkirExport;
use App\Http\Controllers\Controller;
use App\Models\Parkir;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Parkir::with('parkirKeluar')->where('status', 1);

            if ($request->startDate) {
                $data->whereHas('parkirKeluar', function ($q) use ($request) {
                    $q->whereBetween('tgl_keluar', [$request->startDate, $request->endDate]);
                });
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('dashboard.laporan.index');
    }

    public function export(){
        return Excel::download(new ParkirExport, 'Laporan Parkir Keluar.xlsx');
    }
}
