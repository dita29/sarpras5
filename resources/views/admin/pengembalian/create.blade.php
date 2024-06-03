@extends('layouts.master')

@section('tab-title', 'Tambah Peminjaman | Admin')
@section('page-title', 'Tambah Peminjaman')
@section('contents')
    <div class="row">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Pinjam</h3>
                </div>
                <form action="{{ route('peminjaman.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-danger alert-block">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="produk_id" class="form-label">Nama Barang</label>
                                    <select name="produk_id" id="produk_id" class="form-select"
                                        @error('produk_id') is-invalid @enderror autofocus>
                                        <option value="" selected>Pilih Barang</option>
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kode_pinjam" class="form-label">Kode Pinjam</label>
                                    <input type="text" id="kode_pinjam" name="kode_pinjam" class="form-control"
                                        style="text-transform: uppercase" @error('kode_pinjam') is-invalid @enderror />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="peminjam" class="form-label">Peminjam</label>
                                    <input type="text" id="peminjam" name="peminjam" class="form-control"
                                        @error('peminjam') is-invalid @enderror />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" id="jumlah" name="jumlah" class="form-control"
                                        @error('jumlah') is-invalid @enderror value="1" readonly/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kondisi_pinjam" class="form-label">Kondisi</label>
                                    <input type="text" id="kondisi_pinjam" name="kondisi_pinjam"
                                        class="form-control @error('kondisi_pinjam') is-invalid @enderror" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                                    <input type="date" id="tgl_pinjam" name="tgl_pinjam"
                                        class="form-control @error('tgl_pinjam') is-invalid @enderror" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="#" name="kembali" class="btn btn-danger" id="back"><i
                                class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                        <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                            Tambahkan</button>
                    </div>
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
