@extends('layouts.master')

@section('tab-title', 'Stok Masuk | Admin')
@section('page-title', 'Stok Masuk')
@section('contents')
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h4 class="card-title">Tambah Stok</h4>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('stokIn.create') }}" class="btn btn-success">Tambah Stok</a>
                                <a href="{{ route('stokIn.export') }}" class="btn btn-warning ms-2">Export Excel</a>
                                <a href="{{ route('stokIn.exportPdf') }}" class="btn btn-warning ms-2">Export Pdf</a>
                            </div>
                            {{-- <div class="col-auto">
                                <input type="text" name="keyword" id="keyword" class="form-control"
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50px">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Penempatan</th>
                                <th scope="col">Merk</th>
                                <th scope="col">Harga Beli</th>
                                <th scope="col">Tanggal Beli</th>
                                <th scope="col">Jumlah Barang Masuk</th>
                                <th style="width: 150px" scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stokIns as $stokIn)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $stokIn->produk->nama_produk }}</td>
                                    <td>{{ $stokIn->tempat->nama_tempat }}</td>
                                    <td>{{ $stokIn->merk }}</td>
                                    <td>Rp. {{ number_format($stokIn->harga_beli, 0, ',', '.') }}</td>
                                    <td>{{ optional($stokIn->tgl_beli)->isoFormat('dddd, DD MMMM Y') }}</td>
                                    <td>{{ $stokIn->qty }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-auto">
                                                <a href="{{ route('stokIn.edit', $stokIn->id) }}"
                                                    class="btn btn-sm btn-secondary">Edit</a>
                                            </div>
                                            <div class="col-auto">
                                                <form action="{{ route('stokIn.destroy', $stokIn->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-flat show-alert-delete-box btn-sm btn-delete">Hapus</button>
                                                    <div class="row">
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Stok Masuk belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $produks->links() }} --}}
                </div>
            </div>
        </div>
        <div class="d-flex mt-2">
            {!! $stokIns->links() !!}
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
