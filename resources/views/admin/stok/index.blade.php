@extends('layouts.master')

{{-- @section('tab-title' 'Stok Produk | Admin')
@section('page-title' 'Stok Produk') --}}
@section('contents')
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h4 class="card-title">Total Stok</h4>
                </div>
                <div class="card-body mb-0">
                    <form action="#">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('stok.export') }}" class="btn btn-warning">Export Excel</a>
                                <a href="{{ route('stok.exportPdf') }}" class="btn btn-warning" class="btn btn-warning">Export Pdf</a>
                                {{-- <a href="{{ route('kategori.create') }}" class="btn btn-success">Tambah Kategori</a> --}}
                            </div>
                            {{-- <div class="col-auto">
                                <input type="text" name="keyword" class="form-control"
                                    placeholder="ketik keyword disini">
                            </div> --}}
                            {{-- <div class="col-auto">
                                <button class="btn btn-primary">
                                    Cari
                                </button>
                            </div> --}}
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50px">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Kategori</th>
                                    {{-- <th scope="col">Total Barang Masuk</th>
                                    <th scope="col">Total Barang Keluar</th>
                                    <th scope="col">Tanggal Dibuat</th> --}}
                                    <th scope="col">Sisa Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produks as $produk)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $produk->nama_produk }}</td>
                                        <td>{{ $produk->kategori->nama_kategori }}</td>
                                        {{-- <td>{{ $produk->stokin->sum('qty'), }}</td>
                                        <td>{{ $produk->stokout->sum('jumlah') }}</td>
                                        <td>{{ optional($produk->created_at)->isoFormat('dddd, DD MMMM Y') }}</td> --}}
                                        <td>{{ $produk->qty }}</td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-fex mt-2">
            {!! $produks->links() !!}
        </div>
    </div>
    <script>
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endsection
