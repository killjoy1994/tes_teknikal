<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\Transaksi;
use Carbon\Carbon;
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
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];

        $messages = [
            'jenisBarang_first.different' => 'Jenis barang tidak boleh sama.',
        ];

        $validatedData = $request->validate($rules, $messages);

        // dd($request->all());

        $data = [
            'barang_1' => $validatedData['jenisBarang_first'],
            'barang_2' => $validatedData['jenisBarang_second'],
        ];


        $jenisBarangPertama = JenisBarang::findOrFail($data['barang_1']);
        $jenisBarangKedua = JenisBarang::findOrFail($data['barang_2']);

        // ========================= Jenis Barang Pertama ===============================
        $arrBarangPertama = $jenisBarangPertama->barang; // [kopi, teh]

        $arrTransaksiPertama = [];

        foreach ($arrBarangPertama as $item) {
            // $arrTransaksiPertama[] = $item->transaksi;
            foreach ($item->transaksi as $data) {
                $date1 = Carbon::parse($request->start_date)->toDateString();
                $date2 = Carbon::parse($request->end_date)->toDateString();
                $dataDate = Carbon::parse($data->created_at)->toDateString();

                if (($date1 < $dataDate) && ($date2 >= $dataDate)) {
                    $arrTransaksiPertama[] = $item->transaksi;
                }
            }
        }

        // dd($arrTransaksiPertama);

        $arrTotalQuantityPertama = [];

        foreach ($arrTransaksiPertama as $key => $item) {
            $total = 0;
            foreach ($item as $data) {
                $total += $data->quantity;
            }
            $arrTotalQuantityPertama[] = [
                'barang_id' => $arrTransaksiPertama[$key][0]->barang_id,
                'total_quantity' => $total
            ];
        }

        $maxQuantityPertama = 0;
        $maxBarangIdPertama = null;

        foreach ($arrTotalQuantityPertama as $item) {
            if ($item['total_quantity'] > $maxQuantityPertama) {
                $maxQuantityPertama = $item['total_quantity'];
                $maxBarangIdPertama = $item['barang_id'];
            }
        }

        $minQuantityPertama = PHP_INT_MAX;
        $minBarangIdPertama = null;

        foreach ($arrTotalQuantityPertama as $item) {
            if ($item['total_quantity'] < $minQuantityPertama) {
                $minQuantityPertama = $item['total_quantity'];
                $minBarangIdPertama = $item['barang_id'];
            }
        }


        if ($maxBarangIdPertama != null && $minBarangIdPertama != null) {
            $data1 = [
                'nama_barang_tertinggi' => Barang::findOrFail($maxBarangIdPertama)->nama_barang,
                'nama_barang_terendah' => Barang::findOrFail($minBarangIdPertama)->nama_barang,
                'penjualan_tertinggi' => $maxQuantityPertama,
                'penjualan_terendah' => $minQuantityPertama
            ];
        } else {
            $data1 = null;
        }


        // ========================= Jenis Barang Kedua ===============================
        $arrBarangKedua = $jenisBarangKedua->barang; // [kopi, teh]

        $arrTransaksiKedua = [];

        foreach ($arrBarangKedua as $item) {
            // $arrTransaksiKedua[] = $item->transaksi;
            foreach ($item->transaksi as $data) {
                $date1 = Carbon::parse($request->start_date)->toDateString();
                $date2 = Carbon::parse($request->end_date)->toDateString();
                $dataDate = Carbon::parse($data->created_at)->toDateString();

                if (($date1 < $dataDate) && ($date2 >= $dataDate)) {
                    $arrTransaksiKedua[] = $item->transaksi;
                }
            }
        }

        // dd($arrTransaksiPertama);

        $arrTotalQuantityKedua = [];

        foreach ($arrTransaksiKedua as $key => $item) {
            $total = 0;
            foreach ($item as $data) {
                $total += $data->quantity;
            }
            $arrTotalQuantityKedua[] = [
                'barang_id' => $arrTransaksiKedua[$key][0]->barang_id,
                'total_quantity' => $total
            ];
        }

        //  dd($arrTotalQuantityKedua);

        $maxQuantityKedua = 0;
        $maxBarangIdKedua = null;

        foreach ($arrTotalQuantityKedua as $item) {
            if ($item['total_quantity'] > $maxQuantityKedua) {
                $maxQuantityKedua = $item['total_quantity'];
                $maxBarangIdKedua = $item['barang_id'];
            }
        }

        //  dd($maxBarangIdKedua);

        $minQuantityKedua = PHP_INT_MAX;
        $minBarangIdKedua = null;

        foreach ($arrTotalQuantityKedua as $item) {
            if ($item['total_quantity'] < $minQuantityKedua) {
                $minQuantityKedua = $item['total_quantity'];
                $minBarangIdKedua = $item['barang_id'];
            }
        }


        if ($maxBarangIdKedua != null && $minBarangIdKedua != null) {
            $data2 = [
                'nama_barang_tertinggi' => Barang::findOrFail($maxBarangIdKedua)->nama_barang,
                'nama_barang_terendah' => Barang::findOrFail($minBarangIdKedua)->nama_barang,
                'penjualan_tertinggi' => $maxQuantityKedua,
                'penjualan_terendah' => $minQuantityKedua
            ];
        } else {
            $data2 = null;
        }

        // dd($data2);
        $carbonDate1 = Carbon::createFromFormat('Y-m-d', $request->start_date);
        $start_date = $carbonDate1->format('d/m/Y');

        $carbonDate2 = Carbon::createFromFormat('Y-m-d', $request->end_date);
        $end_date = $carbonDate2->format('d/m/Y');

        return view('transaksi.compare.index', compact('jenisBarangPertama', 'jenisBarangKedua', 'data1', 'data2', 'start_date', 'end_date'));
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
