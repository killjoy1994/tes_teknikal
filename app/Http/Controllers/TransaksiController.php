<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksiData = Transaksi::all();

        return view("index", compact('transaksiData'));
    }

    public function create()
    {
        $jenisBarangData = JenisBarang::all();
        $barangData = Barang::all();
        return view("create", compact('jenisBarangData', 'barangData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_barang_id' => 'required',
            'barang_id' => 'required',
            'quantity' => 'required'
        ]);

        $transaksi = Transaksi::create([
            'barang_id' => $validated['barang_id'],
            'quantity' => $validated['quantity']
        ]);

        return redirect('/')->with('message', 'Transaksi berhasil dibuat');
    }

    public function fetchBarang(Request $request)
    {
        $barangData = Barang::where('jenis_barang_id', $request->jenisBarangId)->pluck('id', 'nama_barang');

        return response()->json($barangData);
    }

    public function edit($id)
    {
        $jenisBarangData = JenisBarang::all();
        $transaksiData = Transaksi::findOrFail($id);
        $barang = $transaksiData->barang->get();
        dd($barang);

        return view('edit', compact('jenisBarangData', 'transaksiData'));
    }
}
