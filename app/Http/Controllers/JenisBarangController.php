<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    public function index()
    {
        $jenisBarang = JenisBarang::all();

        $title = 'Hapus jenis barang!';
        $text = "Apakah anda yakin menghapus?";
        confirmDelete($title, $text);
        
        return view('jenisBarang.index', compact('jenisBarang'));
    }

    public function create()
    {
        return view('jenisBarang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => "required"
        ], [
            'nama.required' => 'Nama jenis barang tidak boleh kosong.'
        ]);

        JenisBarang::create([
            'nama' => $validated['nama']
        ]);

        return redirect('/jenis-barang')->with('message', 'Jenis barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jenisBarang = JenisBarang::findOrFail($id);

        return view('jenisBarang.edit', compact('jenisBarang'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => "required"
        ], [
            'nama.required' => 'Nama jenis barang tidak boleh kosong.'
        ]);

        $jenisBarang = JenisBarang::findOrFail($id);

        $jenisBarang->update([
            'nama' => $validated['nama']
        ]);

        return redirect('/jenis-barang')->with('message', 'Jenis barang berhasil diupdate');
    }

    public function destroy($id)
    {
        $jenisBarang = JenisBarang::findOrFail($id);

        $jenisBarang->delete();

        return redirect('/jenis-barang')->with('message', 'Jenis barang berhasil dihapus');
    }
}
