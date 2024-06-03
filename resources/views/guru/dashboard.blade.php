@extends('layouts.gurumaster')

@section('tab-title', 'Dashboard | Admin')
@section('page-title', 'Dashboard')
@section('contents')
<div class="row">

    <!-- Total Keseluruhan Produk -->
    <div class="col-md-3">
        <!-- Total Produk -->
        <div class="col">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Barang Milik Admin<h3>{{ $produk }}</h3></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>

        <!-- Total Stok Produk -->
        <div class="col">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Stok Barang <h3>{{ $stok }}</h3></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>
    </div>

    <!-- Total Produk Pinjam -->
    <div class="col-md-3">

        <!-- Total Stok Produk Pinjam -->
        <div class="col">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Total Barang Belum Dikembalikan <h3>{{ $pro_pjm_total }}</h3></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>
    </div>

    <!-- Total Produk Tak Pinjam -->
    <div class="col-md-3">
    </div>
</div>
@endsection

