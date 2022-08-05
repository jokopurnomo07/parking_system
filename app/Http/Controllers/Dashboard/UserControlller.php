<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Parkir;
use Illuminate\Http\Request;
use DataTables;

class UserControlller extends Controller
{
    public function index(Request $request)
    {
        $data = Parkir::with('parkirKeluar')->where('status', 0);

        if ($request->ajax()) {

            return \DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('dashboard.user');
    }
}
