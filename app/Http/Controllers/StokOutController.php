<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\Produk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockOutExport;
use PDF;

class StokOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stokOuts = Pinjam::paginate(10);
        $produk = Produk::orderBy('nama_produk')->get();
        return view('admin.stokOut.index', compact('produk', 'stokOuts'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $produks = Produk::orderBy('kategori_id', 'asc')
            ->where('qty', '>', 0)
            ->whereIn('pinjam', ['ya'])
            ->get();
        return view('admin.stokOut.create', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'produk_id' => 'required',
                'qty' => 'required|min:1|max:500',
                'pemohon' => 'required',
            ],
            [
                'produk_id.required' => 'Produk Harus Dipilih',
                'qty.required' => 'Jumlah Produk Keluar Harus Diisi',
                'qty.numeric' => 'Jumlah Produk Keluar Harus Berupa Angka',
                'qty.min' => 'Jumlah Produk Keluar Minimal 1',
                'qty.max' => 'Jumlah Produk Keluar Tidak boleh Lebih Dari 500',
                'pemohon.required' => 'Pemohon Harus Diisi',
                ]
            );

        $produk = Produk::findOrFail($request->produk_id);
        $produk->qty;

        if($produk->qty == 0 ){
            toast('Maaf Stok Produk '.$produk->nama_produk.' Telah Habis','error')->autoClose(3000);
            return redirect()->route('stokOut.create');
        } elseif($request->qty > $produk->qty) {
            return back()->with('error', 'Maaf Jumlah Produk '.$produk->nama_produk.' Saat Ini Tersisa '.$produk->qty);
        } else{
            $stokOut['produk_id'] = $request->input('produk_id');
            $stokOut['qty'] = $request->input('qty');
            $stokOut['pemohon'] = $request->input('pemohon');
            if($request->keterangan == ""){
                $ket = "Tanpa Keterangan";
                $stokOut['keterangan'] = $ket;
            } else {
                $stokOut['keterangan'] = $request->input('keterangan');
            }

            StokOut::create($stokOut);

            $produk = Produk::findOrFail($request->produk_id);
            $produk->qty -= $request->qty;
            $produk->save();

        }

        if (!$request) {
            toast('Stok keluar gagal ditambahkan','error')->autoClose(1500);
            return redirect()->route('stokOut.create');
        } else {
            toast('Stok keluar Berhasil ditambah','success')->autoClose(1500);
            return redirect()->route('stokOut.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StokOut  $stokOut
     * @return \Illuminate\Http\Response
     */
    public function show(StokOut $stokOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StokOut  $stokOut
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stokOut = StokOut::findOrFail($id);
        $produks = Produk::orderBy('nama_produk')->get();
        return view('admin.stokOut.edit', compact('produks', 'stokOut'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StokOut  $stokOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stokOut = StokOut::findOrFail($id);
        $pro = Produk::findOrFail($request->produk_id);
        $prod = $pro->qty + $stokOut->qty;
        if($prod < $request->qty){
            return redirect()->route('stokOut.edit', $stokOut->id)->with('error', 'Maaf Jumlah Produk '.$pro->nama_produk.' Saat Ini Tersisa '.$prod);
        } else{
            try {
                $produk = Produk::findOrFail($request->produk_id);
                $produk->qty += $stokOut->qty;
                $produk->update();
            } catch (Exception $e) {
                return redirect()->route('stokOut.edit', $stokOut->id).$e->message();
            }
        }
        $request->validate(
            [
                'produk_id' => 'required',
                'qty' => 'required|min:1|max:500',
                'pemohon' => 'required',
            ],
            [
                'produk_id.required' => 'Produk Harus Dipilih',
                'qty.required' => 'Jumlah Produk Keluar Harus Diisi',
                'qty.numeric' => 'Jumlah Produk Keluar Harus Berupa Angka',
                'qty.min' => 'Jumlah Produk Keluar Minimal 1',
                'qty.max' => 'Jumlah Produk Keluar Tidak boleh Lebih Dari 500',
                'pemohon.required' => 'Pemohon Harus Diisi',
            ]
        );

        if($request->qty < $produk->qty) {

            $prod = Produk::findOrFail($request->produk_id);
            $prod->qty -= $request->qty;
            $prod->update();

            $stokOut->update(
                [
                    'produk_id' => $request->input('produk_id'),
                    'qty' => $request->input('qty'),
                    'pemohon' => $request->input('pemohon'),
                    'keterangan' => $request->input('keterangan')
                ]
            );

            if (!$request) {
                toast('Stok keluar gagal ditambahkan','error')->autoClose(1500);
                return redirect()->route('stokOut.create');
            } else {
                toast('Stok keluar Berhasil ditambah','success')->autoClose(1500);
                return redirect()->route('stokOut.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StokOut  $stokOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $stokOut = Pinjam::findOrFail($id);
        $stokOut->delete();
        toast('Berhasil Dihapus', 'success')->autoClose(1500);
        return redirect()->route('stokOut.index');
    }

    public function exportExcel()
    {
        return Excel::download(new StockOutExport, 'barang_keluar.xlsx');
        // return (new StockExport ($this->selected))->download('barang_masuk.xlsx');
    }

    public function exportPdf()
    {
        $datas = Pinjam::all();
        view()->share('datas', $datas);
        $pdf = PDF::loadview('admin.stokOut.export-pdf');
        return $pdf->download('barang_keluar.pdf');
        // return view('admin.stokIn.export-pdf', compact('datas'))->with('no', 1);
    }
}
