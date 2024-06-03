@extends('layouts.master')

@section('tab-title', 'Peminjaman | Admin')
@section('page-title', 'Peminjaman')
@section('contents')
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h4 class="card-title">Peminjaman Barang</h4>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="row">
                            <div class="col">
                                {{-- <a     href="{{ route('peminjaman.create') }}" class="btn btn-success">Tambah Peminjaman</a> --}}
                            </div>
                            {{-- <div class="col-auto">
                                <input type="text" name="keyword" id="keyword" class="form-control"
                                    placeholder="ketik keyword disini">
                            </div>
                            <div class="col-auto">
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
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Kode Pinjam</th>
                                <th scope="col">Peminjam</th>
                                <th scope="col">Jumlah (pcs)</th>
                                <th scope="col">Kondisi Kembali</th>
                                <th scope="col">Tanggal Kembali</th>
                                <th scope="col">Status</th>
                                <th style="width: 150px" scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pinjams as $pinjam)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $pinjam->produk->nama_produk }}</td>
                                    <td>{{ $pinjam->kode_pinjam }}</td>
                                    <td>{{ $pinjam->peminjam }}</td>
                                    <td>{{ $pinjam->jumlah }}</td>
                                    <td>{{ $pinjam->kondisi_kembali }}</td>
                                    <td>{{ $pinjam->tgl_kembali }}</td>
                                    <td>{{ $pinjam->status }}</td>
                                    <td>
                                        <a href="{{ route('pengembalian.edit', $pinjam->id) }}" class="btn btn-sm btn-secondary">Kembalikan</a>
                                        {{-- <button type="button" class="btn btn-secondary btn-sm" >
                                            Kembalikan
                                        </button> --}}
                                        {{-- <form action="{{ route('pengembalian.destroy', $pinjam->id) }}" method="POST">
                                            <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-sm btn-secondary">Detail</a>
                                            <a href="{{ route('pengembalian.edit', $pinjam->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger btn-flat show-alert-delete-box btn-sm btn-delete">Kembalikan</button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Peminjaman Belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $produks->links() }} --}}
                </div>
            </div>
        </div>
        <div class="d-flex mt-2">
            {!! $pinjams->links() !!}
        </div>
    </div>

    <!-- Modal Edit -->
    {{-- <div class="modal fade" id="editKembali" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pengembalian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

            </div>
        </div>
    </div> --}}


    <script>
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endsection
