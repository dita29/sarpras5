@extends('layouts.master')

@section('tab-title', 'Riwayat Transaksi Barang | Admin')
@section('page-title', 'Riwayat Transaksi Barang')
@section('contents')
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow rounded">
                {{-- <div class="card-header">
                    <h4 class="card-title">Kurangi Stok</h4>
                </div> --}}
                <div class="card-body">
                    <form action="#">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('stokOut.export') }}" class="btn btn-warning">Ekspor Excel</a>
                                <a href="{{ route('stokOut.exportPdf') }}" class="btn btn-warning">Ekspor Pdf</a>
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
                                <th scope="col">Jumlah Barang Keluar</th>
                                <th scope="col">Tanggal Keluar</th>
                                <th scope="col">Pemohon</th>
                                <th scope="col">Status</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stokOuts as $stokOut)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $stokOut->produk->nama_produk }}</td>
                                    <td>{{ $stokOut->jumlah }}</td>
                                    <td>{{ $stokOut->created_at->isoFormat('dddd, DD MMMM Y') }}</td>
                                    <td>{{ $stokOut->peminjam }}</td>
                                    <td>{{ $stokOut->status }}</td>
                                    <td>{{ $stokOut->kondisi_kembali }}</td>
                                    <td>

                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Stok Keluar belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $produks->links() }} --}}
                </div>
            </div>
        </div>
        <div class="d-flex mt-2">
            {!! $stokOuts->links() !!}
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
