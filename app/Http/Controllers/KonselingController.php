<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonselingController extends Controller
{
    public function show(Request $request)
    {
        $id = $request->query('id');  // Ambil id dari URL ?id=xxx

        // Ambil data detail dari DB sesuai $id (contoh)
        // $detail = JadwalKonseling::find($id);

        // Kirim data ke view
        return view('detailkonseling', compact('id' /*, 'detail'*/));
    }
}

