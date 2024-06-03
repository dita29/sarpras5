<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Tempat;
use App\Models\Pinjam;
use App\Models\StokOut;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DetailProdukExport;
use PDF;

class PinjamController extends Controller
{
    public function index()
    {
        $pinjams = Pinjam::all();
        return view('admin.peminjaman.index', compact('pinjams'));
    }

    public function create()
    {
        $tempats = Tempat::select('id', 'nama_tempat')->get();
        $kategoris = Kategori::select('id', 'nama_kategori')->get();
        return view('admin.produk.create', compact('kategoris', 'tempats'));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'nama_produk' => 'unique:produks|required',
                'kode_produk' => 'unique:produks,kode_produk|required|regex:/^\S*$/u',
                'kategori_produk' => 'required',
                'pinjam' => 'required',
                'foto_produk' => 'image|mimes:jpeg,png,jpg,webp|file|max:2048',
            ],
            [
                'kode_produk.required' => 'Kode produk harus diisi',
                'kategori_produk' => 'Kategori produk harus diisi',
                'pinjam.required' => 'harap Dipilih',
                'nama_produk.unique' => 'Nama produk ini sudah ada',
                'nama_produk.required' => 'Nama produk harus diisi',
                'kode_produk.unique' => 'Kode produk ini sudah ada',
                'kode_produk.regex' => 'Maaf kode produk tidak boleh ada spasi',
                'foto_produk.image' => 'Format foto produk yang dapat diinputkan adalah jpeg, png, jpg, dan webp',
                'foto_produk.file.max' => 'Maksimal ukuran foto yang dapat diinputkan adalah 2 Mb'
                // 'jml_produk' => 'Jumlah produk harus diisi',
            ]
        );

        if($request->file('foto_produk')){
            $img_name = time() . '_' . Str::title($request->nama_produk) . '.' . $request->foto_produk->extension();
            $request->foto_produk->storeAs('public/produk/', $img_name);
            $produk['foto_produk'] = $img_name;
        }

        $pjm = $request->input('pinjam');

        if ($pjm == 'ya') {
            $ok = "ya";
            $produk['pinjam'] = $ok;
        } elseif ($pjm == 'tidak') {
            $ko = "tidak";
            $produk['pinjam'] = $ko;
        }

        $produk['nama_produk'] = Str::title($request->input('nama_produk'));
        $produk['kode_produk'] = strtoupper($request->input('kode_produk'));
        $produk['kategori_id'] = $request->input('kategori_produk');
        $produk['pinjam'] = $request->input('pinjam');

        // dd($produk);
        Produk::create($produk);

        if (!$request) {
            toast('Produk gagal disimpan', 'error')->autoClose(1500);
            return redirect()->route('produk.create');
        } else {
            toast('Produk Berhasil disimpan', 'success')->autoClose(1500);
            return redirect()->route('produk.index');
        }

        return view('admin.produk.index');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Pinjam::findOrFail($id);
        $produkId = $produk->produk->id;
        // $out = StokOut::where('produk_id', $produkId)->first();
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('admin.produk.edit', compact('produk', 'kategoris'));

        // dd($produk);
    }

    public function update(Request $request, $id)
    {try {
        $produk = Pinjam::findOrFail($id);
        $produkId = $produk->produk->id;
        $in = Produk::where('id', $produkId)->first();

        if ($request->pinjam == "Disetujui") {
            $in->update([
                'qty' =>  $in->qty - $request->jumlah_barang
            ]);
            $produk->update([
                'kondisi_kembali' => $request->kondisi_kembali,
                'tgl_kembali' => date('Y-m-d H:i:s'),
                'status' => $request->pinjam,
            ]);

            // StokOut::create([
            //     'qty' => $request->jumlah_barang,
            //     'nama_produk' => $request->nama_produk,
            //     'pemohon' => $request->nama_peminjam,
            //     'keterangan' => $request->kondisi_kembali
            // ]);
            toast('Produk Berhasil disimpan', 'success')->autoClose(1500);
            return redirect()->route('peminjaman.index');

        }else if($request->pinjam == "Dikembalikan"){
            $in->update([
                'qty' =>  $in->qty + $request->jumlah_barang
            ]);
            $produk->update([
                'kondisi_kembali' => $request->kondisi_kembali,
                'tgl_kembali' => date('Y-m-d H:i:s'),
                'status' => $request->pinjam,
            ]);
            toast('Produk Berhasil disimpan', 'success')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        }
        else {
            $produk->update([
                'kondisi_kembali' => $request->kondisi_kembali,
                'tgl_kembali' => date('Y-m-d H:i:s'),
                'status' => $request->pinjam,
            ]);
            toast('Produk Berhasil disimpan', 'success')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        }
    } catch (\Exception $e) {
        // Tangani pengecualian di sini
        toast('Terjadi kesalahan: ' . $e->getMessage(), 'error')->autoClose(5000);
        return redirect()->route('peminjaman.index');
    }

    }

    public function destroy($id)
    {
        try {
            $pinjam = Pinjam::findOrFail($id);
            $pinjam->delete();
            toast('Berhasil Dihapus', 'success')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        }  catch (\Exception $e) {
            // Tangani pengecualian di sini
            toast('Terjadi kesalahan: ' . $e->getMessage(), 'error')->autoClose(5000);
            return redirect()->route('peminjaman.index');
        }


    }

    public function exportExcel()
    {
        return Excel::download(new DetailProdukExport, 'detail_produk.xlsx');
        // return (new StockExport ($this->selected))->download('barang_masuk.xlsx');
    }

    public function exportPdf()
    {
        $datas = Produk::all();
        view()->share('datas', $datas);
        $pdf = PDF::loadview('admin.stokIn.export-pdf');
        return $pdf->download('barang_masuk.pdf');
        return view('admin.stokIn.export-pdf', compact('datas'))->with('no', 1);
    }
}
