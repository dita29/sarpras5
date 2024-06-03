<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\StokIn;
use App\Models\Pinjam;
use App\Exports\ProdukExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produks = Produk::with('stokin', 'stokout')->orderBy('kategori_id', 'asc')->paginate(5);
        // $out = StokOut::sum('qty');

        return view('admin.stok.index', compact('produks'))->with('no', 1);
        // dd($qtyIn, $qtyOut);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportExcel()
    {
        return Excel::download(new ProdukExport, 'total_barang.xlsx');
        // return (new StockExport ($this->selected))->download('barang_masuk.xlsx');
    }

    public function exportPdf()
    {
        $datas = Produk::all();
        view()->share('datas', $datas);
        $pdf = PDF::loadview('admin.stok.export-pdf');
        return $pdf->download('total_barang.pdf');
        // return view('admin.stok.export-pdf', compact('datas'))->with('no', 1);
    }
}
