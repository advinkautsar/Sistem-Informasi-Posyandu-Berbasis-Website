<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\HasilKegiatanExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanExportController extends Controller
{
    public function hasilkegiatan($id)
    {
        return Excel::download(new HasilKegiatanExport($id), 'DATA HASIL KEGIATAN POSYANDU.xlsx');
    }
}
