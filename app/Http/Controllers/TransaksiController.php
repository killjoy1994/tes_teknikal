<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Mockery\Undefined;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksiData = Transaksi::paginate(7);

        return view("transaksi.index", compact('transaksiData'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');

        if (empty($keyword)) {
            return redirect('/');
        }

        $transaksiData = Transaksi::whereHas('barang', function ($query) use ($keyword) {
            $query->where('nama_barang', 'like', '%' . $keyword . '%');
        })->paginate(7);

        return view('transaksi.index', compact('transaksiData'));
    }

    public function compare()
    {
        $jenisBarangData = JenisBarang::all();
        return view('transaksi.compare.create', compact('jenisBarangData'));
    }

    public function comparingData(Request $request)
    {
        // dd($request->all());
        $rules = [
            'jenisBarang_first' => 'required|different:jenisBarang_second',
            'jenisBarang_second' => 'required',
        ];

        $messages = [
            'jenisBarang_first.different' => 'The first jenis barang must be different from the second jenis barang.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $data = [
            'barang_1' => $validatedData['jenisBarang_first'],
            'barang_2' => $validatedData['jenisBarang_second'],
        ];

        $jenisBarangPertama = JenisBarang::findOrFail($data['barang_1']);
        $jenisBarangKedua = JenisBarang::findOrFail($data['barang_2']);

        $barangPertama = $jenisBarangPertama->barang; // [kopi, teh]

        // $transaksiPertamaTertinggi = null;
        // $quantityTertinggi = 0;

        $dataTransaksiPertama = []; // [[barang_id: 1 quantity: 10], [barang_id: 2, quantity: 6]];

        foreach ($barangPertama as $data) {
            $dataTransaksiPertama[] = $data->transaksi;
        }

        dd($dataTransaksiPertama);

        return view('transaksi.compare.index', compact('jenisBarangPertama', 'jenisBarangKedua'));
    }

    public function create()
    {
        $jenisBarangData = JenisBarang::all();
        $barangData = Barang::all();
        return view("transaksi.create", compact('jenisBarangData', 'barangData'));
    }

    public function sort(Request $request)
    {
        $sortBy = $request->input('sort_by');

        if ($sortBy == "") {
            return redirect('/');
        }

        $transaksiData = "";

        if ($sortBy == "nama_barang_asc") {
            $transaksiData = Transaksi::join('barang', 'transaksi.barang_id', '=', 'barang.id')
                ->orderBy('barang.nama_barang', 'asc')
                ->paginate(7);
        } else if ($sortBy == "nama_barang_desc") {
            $transaksiData = Transaksi::join('barang', 'transaksi.barang_id', '=', 'barang.id')
                ->orderBy('barang.nama_barang', 'desc')
                ->paginate(7);
        } else if ($sortBy == "tanggal_transaksi_asc") {
            $transaksiData = Transaksi::orderBy('created_at', 'asc')->paginate(7);
        } else if ($sortBy == "tanggal_transaksi_desc") {
            $transaksiData = Transaksi::orderBy('created_at', 'desc')->paginate(7);
        }
        // dd($transaksiData);

        return view('transaksi.index', compact('transaksiData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_barang_id' => 'required',
            'barang_id' => 'required',
            'quantity' => 'required',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // dd($barang->stok);

        $transaksi = Transaksi::create([
            'barang_id' => $validated['barang_id'],
            'stok_sisa' => $barang->stok,
            'quantity' => $validated['quantity']
        ]);

        $transaksi->barang()->update([
            'stok' => $transaksi->barang->stok - $request->quantity
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
        $barang = Barang::where('jenis_barang_id', $transaksiData->barang->jenis_barang_id)->get();
        // dd($barang);

        return view('transaksi.edit', compact('jenisBarangData', 'transaksiData', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis_barang_id' => 'required',
            'barang_id' => 'required',
            'quantity' => 'required'
        ]);

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'barang_id' => $validated['barang_id'],
            'quantity' => $validated['quantity']
        ]);

        return redirect('/')->with('message', 'Transaksi berhasil diupdate');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->barang->update([
            'stok' => $transaksi->barang->stok + $transaksi->quantity
        ]);

        $transaksi->delete();

        return redirect('/')->with('message', 'Transaksi berhasil dihapus');
    }
}
