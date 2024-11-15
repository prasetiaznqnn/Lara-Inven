<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view("databarang", ['barang' => $barang]);
    }

    public function store(Request $request)
    {
        // Loop untuk menyimpan data multiple item barang
        foreach ($request->kode_barang as $index => $kode_barang) {
            Barang::create([
                'kode_barang' => $kode_barang,
                'jenis_barang' => $request->jenis_barang[$index],
                'nama_barang' => $request->nama_barang[$index],
                'deskripsi' => $request->dekripsi[$index],
                'maker' => $request->maker[$index],
                'stok' => 0, // Set default stok
            ]);
        }

        return redirect()->back()->with('success', 'Data Barang berhasil ditambahkan.');
    }
}
