@extends('layouts.master')

@section('tab-title', 'Produk | Admin')
@section('page-title', 'Produk')
@section('contents')
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h4 class="card-title">Daftar Peminjaman</h4>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="row">

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
                                <th>No</th>
                                <th>Kode</th>
                                <th>Produk</th>
                                <th>Peminjam</th>
                                <th>Jumlah (pcs)</th>
                                <th>Kondisi Pinjam</th>
                                <th>Kondisi Kembali</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @forelse ($pinjams as $pinjam)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $pinjam->produk->nama_produk }}</td>
                                    <td>{{ $pinjam->kode_pinjam }}</td>
                                    <td>{{ $pinjam->peminjam }}</td>
                                    <td>{{ $pinjam->jumlah }}</td>
                                    <td>{{ $pinjam->kondisi_pinjam }}</td>
                                    <td>{{ $pinjam->kondisi_kembali }}</td>
                                    <td>{{ $pinjam->status }}</td>
                                    <td>
                                        <form action="{{ route('peminjaman.destroy', $pinjam->id) }}" method="POST">
                                            {{-- <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-sm btn-secondary">Detail</a> --}}
                                            <a href="{{ route('peminjaman.edit', $pinjam->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-flat show-alert-delete-box btn-sm btn-delete">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Barang belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $produks->links() }} --}}
                </div>
            </div>
        </div>
        <div class="d-flex mt-2">
            {{-- {!! $pinjams->links() !!} --}}
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
