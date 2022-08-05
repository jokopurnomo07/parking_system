<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Parkir;
use App\Models\ParkirKeluar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $jmlTransaksi = Parkir::where('status', 1)->count();
        $jmlPelangganParkir = Parkir::count();
        $jmlPenghasilan = ParkirKeluar::sum('tarif');

        return view('dashboard.index', compact('jmlTransaksi', 'jmlPelangganParkir', 'jmlPenghasilan'));
    }
}
