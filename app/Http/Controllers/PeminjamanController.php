<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeminjamanExport;
use PDF;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedInUser = Auth::user();
        $loggedInUserName = $loggedInUser ? $loggedInUser->name : null;
        $pinjams = Pinjam::where('peminjam', $loggedInUserName)->get();
        return view('guru.peminjaman.index', compact('pinjams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = Produk::orderBy('kategori_id', 'asc')
            ->whereIn('pinjam', ['ya'])
            ->get();
            $kategoris = Kategori::paginate(10);

        return view('guru.peminjaman.create', compact('produks', 'kategoris'))->with('no', 1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        try {
    // $request->validate([
    //     'kode_pinjam' => 'required',
    //     'peminjam' => 'required',
    //     'jumlah' => 'required|min:1',
    //     'kondisi_pinjam' => 'required',
    //     'tgl_pinjam' => 'required',
    // ]);

    $produk = Produk::findOrFail($request->selected_label);
    $loggedInUser = Auth::user();
    $loggedInUserName = $loggedInUser ? $loggedInUser->name : null;

    if($produk->qty <= 0) {
        toast('Maaf Jumlah '.$produk->nama_produk.' Saat Ini '.$produk->qty, 'error')->autoclose(3000);
        return redirect()->route('peminjamanguru.create');
    } else if($request->jumlah > 1) {
        return redirect()->route('peminjamanguru.create')->with('error', 'Maaf Jumlah Produk '.$produk->nama_produk.' Tidak Boleh Lebih Dari 1');
    } else {
        Pinjam::create([
        'produk_id' => $request->selected_label,
        'kode_pinjam' => $request->kode_produk,
        'peminjam' => $loggedInUser->name,
        'jumlah' => $request->jumlah_produk,
        'kondisi_pinjam' => $request->kondisi_pinjam,
        'tgl_pinjam' =>  date('Y-m-d H:i:s'),
        'status' => "Menunggu",
        ]);

        // $produk->qty -= 1;
        $produk->update();

        toast('Peminjaman Berhasil Disimpan', 'success')->autoClose(1500);
        return redirect()->route('peminjamanguru.index');
    }
} catch (\Exception $e) {
    toast('Terjadi kesalahan: '.$e->getMessage(), 'error')->autoClose(5000);
    return redirect()->route('peminjamanguru.create');
}

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjam $pinjam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $produks = Produk::orderBy('nama_produk')->get();
        return view('guru.peminjaman.edit', compact('pinjam', 'produks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pinjam = Pinjam::findOrFail($id);
        try {
            $produk = Produk::findOrFail($request->produk_id);
            $produk->qty += 1;
            $produk->update();
        } catch (Excepion $e) {
            return redirect()->route('peminjaman.edit').$e->message();
        }
        $request->validate(
            [
                'produk_id' => 'required',
                'kode_pinjam' => 'required',
                'peminjam' => 'required',
                'jumlah' => 'required',
                'kondisi_pinjam' => 'required',
                'tgl_pinjam' => 'required',
            ]
        );

        $pro = Produk::findOrFail($request->produk_id);
        $pro->qty -= 1;
        $pro->update();

        $st = "Dipinjam";

        $pinjam->update(
            [
                'produk_id' => $request->input('produk_id'),
                'kode_pinjam' => strtoupper($request->input('kode_pinjam')),
                'peminjam' => Str::title($request->input('peminjam')),
                'jumlah' => $request->input('jumlah'),
                'kondisi_pinjam' => $request->input('kondisi_pinjam'),
                'tgl_pinjam' => $request->input('tgl_pinjam'),
                // 'kondisi_kembali' => $request->input('kondisi_kembali'),
                // 'tgl_kembali' => $request->input('tgl_kembali'),
                'status' => $st,
            ]
        );

        if(!$request) {
            toast('Peminjaman gagal diupdate', 'error')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        } else {
            toast('Peinjaman berhasil diupdate', 'success')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $produk = $pinjam->produk;

        if (($produk->qty - $pinjam->jumlah) < 0) {
            toast('Maaf Stok Anda Nanti Minus', 'error')->autoclose(1500);
            return redirect()->route('stokIn.index');
        } elseif($produk->qty > 0) {
            $produk->qty += $pinjam->jumlah;
            $produk->save();

            $pinjam->delete();

            toast('Peminjaman Berhasil Dihapus', 'success')->autoClose(1500);
            return redirect()->route('peminjamanguru.index');
        } elseif($produk->qty == 0){
            $produk->qty -= 0;
            $produk->save();

            $pinjam->delete();

            toast('Peminjaman Berhasil Dihapus', 'success')->autoClose(1500);
            return redirect()->route('peminjamanguru.index');
        }
    }

    public function pengembalianEdit($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $produks = Produk::orderBy('nama_produk')->get();
        return view('guru.pengembalian.edit', compact('pinjam', 'produks'));
    }

    public function pengembalian(Request $request, $id) {
        $pinjam = Pinjam::findOrFail($id);
        $produk = Produk::findOrFail($request->produk_id);
        $request->validate(
            [
                // 'produks_id' => 'required',
                'kode_pinjam' => 'required',
                'peminjam' => 'required',
                'jumlah' => 'required',
                'kondisi_kembali' => 'required',
                'tgl_kembali' => 'required',
            ]
        );


        $st = "Dikembalikan";

        // dd($pinjam);

        $pinjam->update(
            [
                // 'produks_id' => $request->input('produks_id'),
                'kode_pinjam' => strtoupper($request->input('kode_pinjam')),
                'peminjam' => Str::title($request->input('peminjam')),
                'jumlah' => $request->input('jumlah'),
                'kondisi_pinjam' => $request->input('kondisi_pinjam'),
                // 'tgl_pinjam' => $request->input('tgl_pinjam'),
                'kondisi_kembali' => $request->input('kondisi_kembali'),
                'tgl_kembali' => $request->input('tgl_kembali'),
                'status' => $st,
            ]
        );

        $pro = Produk::findOrFail($request->produk_id);
        $pro->qty += 1;
        $pro->update();

        if(!$request) {
            toast('Peminjaman gagal diupdate', 'error')->autoClose(1500);
            return redirect()->route('peminjamanguru.index');
        } else {
            toast('Peinjaman berhasil diupdate', 'success')->autoClose(1500);
            return redirect()->route('peminjamanguru.index');
        }
    }

    public function pengembalianIndex()
    {
        $pinjams = Pinjam::paginate(10);
        $produks = Produk::orderBy('nama_produk')->get();
        $produk = Produk::orderBy('nama_produk')->get();
        return view('guru.pengembalian.index', compact('pinjams', 'Produk', 'produks'))->with('no', 1);
    }

    public function exportExcel()
    {
        return Excel::download(new PeminjamanExport, 'detail_peminjaman.xlsx');
        // return (new StockExport ($this->selected))->download('produks_masuk.xlsx');
    }

    public function exportPdf()
    {
    $loggedInUser = Auth::user(); // Mendapatkan objek pengguna yang sedang login
    // Pastikan pengguna sudah login sebelum mengakses nama
    $loggedInUserName = $loggedInUser ? $loggedInUser->name : null;
        // $datas = Pinjam::where('peminjam', $loggedInUserName)->get();
        $datas = Pinjam::where('peminjam', $loggedInUserName)->get();
        view()->share('datas', $datas);
        $pdf = PDF::loadview('admin.stokIn.export-pdf-peminjam');
        return $pdf->download('produk_masuk.pdf');
        // return view('admin.stokIn.export-pdf', compact('datas'))->with('no', 1);
    }
}
