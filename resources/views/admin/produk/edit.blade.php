@extends('layouts.master')

@section('tab-title', 'Edit Produk | Admin')
@section('page-title', 'Edit Produk')
@section('contents')
    <div class="row">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Barang</h3>
                </div>
                <form action="{{ route('peminjaman.update', $produk->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="nama_produk" class="form-label">Nama Barang</label>
                                    <input type="text" id="nama_produk" name="nama_produk"
                                    readonly
                                        style="text-transform: capitalize"
                                        value="{{ $produk->produk->nama_produk }}"
                                        class="form-control @error('nama_produk') is-invalid @enderror" autofocus />
                                    @if ($errors->has('nama_produk'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('nama_produk') }}</span>
                                        </div>
                                    @endif
                                </div>
                                {{-- <div class="form-group mb-3">
                                    <label for="kode_pinjam" class="form-label">Sisa Stok</label>
                                    <input type="text" id="qty" name="qty"
                                    readonly
                                        style="text-transform: capitalize"
                                        value="{{ $produk->produk_id->qty }}"
                                        class="form-control @error('qty') is-invalid @enderror" autofocus />
                                    @if ($errors->has('qty'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('qty') }}</span>
                                        </div>
                                    @endif
                                </div> --}}
                                <div class="form-group mb-3">
                                    <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                                    <input type="text" id="nama_peminjam" name="nama_peminjam"
                                    readonly
                                        style="text-transform: capitalize"
                                        value="{{ $produk->peminjam }}"
                                        class="form-control @error('nama_peminjam') is-invalid @enderror" autofocus />
                                    @if ($errors->has('nama_produk'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('nama_peminjam') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_produk" class="form-label">Jumlah Barang</label>
                                    <input type="text" id="nama_produk" name="jumlah_barang"
                                    readonly
                                        style="text-transform: capitalize"
                                        value="{{ $produk->jumlah }}"
                                        class="form-control @error('nama_produk') is-invalid @enderror" autofocus />
                                    @if ($errors->has('nama_produk'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('nama_produk') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_produk" class="form-label">Kondisi Barang</label>
                                    <input type="text" id="nama_produk" name="kondisi_kembali"
                                        style="text-transform: capitalize"
                                        value="{{ $produk->kondisi_kembali }}"
                                        class="form-control @error('nama_produk') is-invalid @enderror" autofocus />
                                    @if ($errors->has('nama_produk'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('nama_produk') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_produk" class="form-label">Status Persetujuan</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="radio" id="html" name="pinjam" value="Disetujui">
                                            <label for="html" class="me-3">Disetujui</label>
                                            <input type="radio" id="css" name="pinjam" value="Ditolak">
                                            <label for="css">Ditolak</label>
                                            <input type="radio" id="css" name="pinjam" value="Dikembalikan">
                                            <label for="css">Dikembalikan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="{{ route('produk.index') }}" name="kembali" class="btn btn-danger" id="back"><i
                                    class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                            <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                                Simpan</button>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        config = {
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
        }
        flatpickr("input[type=datetime-local]");
    </script>
@endpush
