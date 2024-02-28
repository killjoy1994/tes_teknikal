<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();

        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $jenisBarangData = JenisBarang::all();
        return view('barang.create', compact('jenisBarangData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_barang_id' => 'required',
            'nama_barang' => "required",
            'stok' => 'required'
        ]);

        Barang::create([
            'jenis_barang_id' => $request->jenis_barang_id,
            'nama_barang' => $validated['nama_barang'],
            'stok' => $validated['stok']
        ]);

        return redirect('/barang')->with('message', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jenisBarangData = JenisBarang::all();
        $barang = Barang::findOrFail($id);

        return view('barang.edit', compact('jenisBarangData', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis_barang_id' => "required",
            'nama_barang' => "required",
            'stok' => "required",
        ]);

        $barang = Barang::findOrFail($id);

        $barang->update([
            'jenis_barang_id' => $request->jenis_barang_id,
            'nama_barang' => $validated['nama_barang'],
            'stok' => $validated['stok']
        ]);

        return redirect('/barang')->with('message', 'Barang berhasil diupdate');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        $barang->delete();

        return redirect('/barang')->with('message', 'Barang berhasil dihapus');
    }
}
