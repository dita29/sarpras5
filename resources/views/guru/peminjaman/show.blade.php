@extends('layouts.master')

@section('tab-title', 'Detail Produk | Admin')
@section('page-title', 'Detail Produk')
@section('contents')
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Detail Barang</h3>
            </div>
            <div class="card-body">
                <div class="row no-gutters ml-2 mb-2 mr-2">
                    <div class="col-md-4 mb-2">
                        <img src="{{ asset('storage/produk/'.$produk->foto_produk) }}" class="card-img img-thumbnails"
                        style="max-height: 300px; max-width: 300px; overflow-x: hidden; overflow-y: hidden">
                    </div>
                    <div class="col-md-3">
                        <h5 class="card-title card-text mb-4">Nama Barang</h5>
                        <h5 class="card-title card-text mb-4">Kode Barang</h5>
                        <h5 class="card-title card-text mb-4">Kategori Barang</h5>
                        {{-- <h5 class="card-title card-text mb-4">Harga Beli Produk</h5>
                        <h5 class="card-title card-text mb-4">Satuan Produk</h5>
                        <h5 class="card-title card-text mb-4">Tanggal Beli</h5>
                        <h5 class="card-title card-text mb-4">Jumlah Produk</h5> --}}
                    </div>
                    <div class="col-md-4">
                        <h5 class="card-title card-text mb-4">: {{ $produk->nama_produk }}</h5>
                        <h5 class="card-title card-text mb-4">: {{ $produk->kode_produk }}</h5>
                        <h5 class="card-title card-text mb-4">: {{ $produk->kategori->nama_kategori }}</h5>
                        {{-- <h5 class="card-title card-text mb-4">: {{ $format }}</h5>
                        <h5 class="card-title card-text mb-4">: {{ $produk->satuan_produk }}</h5>
                        <h5 class="card-title card-text mb-4">: {{ $tanggal_beli }}</h5>
                        <h5 class="card-title card-text mb-4">: {{ $sum }}</h5> --}}
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('produk.index') }}" name="kembali" class="btn btn-danger" id="back"><i
                            class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                    <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
