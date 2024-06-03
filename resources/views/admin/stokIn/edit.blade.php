@extends('layouts.master')

@section('tab-title', 'Edit Stok | Admin')
@section('page-title', 'Edit Stok')
@section('contents')
    <div class="row">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Stok</h3>
                </div>
                <form action="{{ route('stokIn.update', $stokIn->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="produk_id" class="form-label">Nama Barang</label>
                                    <select class="form-select @error('produk_id') is-invalid @enderror" id="produk_id"
                                        name="produk_id" autofocus>
                                        <option value="">Pilih Nama Barang</option>
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->id }}"
                                                @if ($stokIn->produk_id == $produk->id) selected @endif>
                                                {{ $produk->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-goup mb-3">
                                    <label for="merk" class="form-label">Merk</label>
                                    <input type="text" id="merk" name="merk" style="text-transform: capitalize"
                                        class="form-control @error('merk') is-invalid @enderror"
                                        value="{{ old('merk', $stokIn->merk) }}" />
                                    @if ($errors->has('merk'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('merk') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_beli" class="form-label">Tanggal Beli Barang</label>
                                    <input type="date" id="tgl_beli" name="tgl_beli"
                                        class="form-control @error('tgl_beli') is-invalid @enderror"
                                        value="{{ old('tgl_beli', optional($stokIn->tgl_beli)->isoFormat('DD/MM/YYYY')) }}" />
                                    @if ($errors->has('tgl_beli'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('tgl_beli') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_tempat" class="form-label">Penepatan Barang</label>
                                    <select name="nama_tempat" id="nama_tempat" class="form-select">
                                        <option value="">Pilih Penematan</option>
                                        @foreach ($tempats as $tempat)
                                            <option value="{{ $tempat->id }}"
                                                @if ($stokIn->tempat_id == $tempat->id) selected @endif>{{ $tempat->nama_tempat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('nama_tempat'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('nama_tempat') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="harga_beli" class="form-label">Harga Beli Barang</label>
                                    <input type="text" id="harga_beli" name="harga_beli"
                                        class="uang form-control @error('harga_beli') is-invalid @enderror"
                                        value="{{ old('harga_beli', $stokIn->harga_beli) }}" />
                                    @if ($errors->has('harga_beli'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('harga_beli') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="qty" class="form-label">Jumlah Barang</label>
                                    <input type="number" id="qty" name="qty"
                                        class="form-control @error('qty') is-invalid @enderror"
                                        value="{{ old('qty', $stokIn->qty) }}" />
                                    @if ($errors->has('qty'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('qty') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ route('stokIn.index', $produk->id) }}" name="kembali" class="btn btn-danger"
                            id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
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
