<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pinjam;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index()
    {

        $produk = DB::table('produks')->count();
        $stok = Produk::sum('qty');
        $pro_pjm = Produk::whereIn('pinjam', ['ya'])->count();
        $pro_hbs = Produk::whereIn('pinjam', ['tidak'])->count();
        $pro_pjm_total = Pinjam::whereIn('status', ['Disetujui'])->sum('jumlah');
        $pro_hbs_total = Produk::whereIn('pinjam', ['tidak'])->sum('qty');
        return view('admin.dashboard', compact('produk', 'stok', 'pro_pjm', 'pro_hbs', 'pro_pjm_total', 'pro_hbs_total'));
    }
}
