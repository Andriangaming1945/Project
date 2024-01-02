<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\NamaImport;
use Maatwebsite\Excel\Facades\Excel;

class YourControllerName extends Controller
{
    public function showImportForm()
    {
        return view('import.form'); // Ganti dengan nama view yang ingin kamu tampilkan
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls', // Pastikan file yang diupload adalah Excel
        ]);

        Excel::import(new NamaImport, $request->file('file'));

        return redirect()->back()->with('success', 'Import Excel berhasil.');
    }
}

?>
