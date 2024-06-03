@extends('layouts.gurumaster')

@section('tab-title', 'Produk | Guru')
@section('page-title', 'Produk')
@section('contents')
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h4 class="card-title">Data Pinjaman Anda</h4>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('peminjamanguru.create') }}" class="btn btn-success">Pinjam Barang</a>
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
                                <th scope="col">Gambar</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Jumlah Pinjam (pcs)</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1?>
                            @forelse ($pinjams as $pinjam)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td class="text-center">
                                        <img src="{{Storage::url('produk/').$pinjam->produk->foto_produk}}"
                                            class="card-img img-thumbnails" style="max-height: 150px; max-width: 150px; overflow-x: hidden; overflow-y: hidden">
                                    </td>
                                    <td>{{ $pinjam->produk->kode_produk }}</td>
                                    <td>{{ $pinjam->produk->nama_produk }}</td>
                                    <td>{{ $pinjam->jumlah }}</td>
                                    <td>{{ $pinjam->status }}</td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Anda Belum Meminjam Barang.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $produks->links() }} --}}
                </div>
            </div>
        </div>
        {{-- <div class="d-flex mt-2">
            {!! $produks->links() !!}
        </div> --}}
    </div>
    <script>
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endsection
