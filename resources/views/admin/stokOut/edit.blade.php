@extends('layouts.master')

@section('tab-title', 'Kurangi Stok | Admin')
@section('page-title', 'Kurangi Stok')
@section('contents')
    <div class="row">
        <div class="col-md-5 mb-3">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h3 class="card-title">Kurangi Data Barang</h3>
                </div>
                <form action="{{ route('stokOut.update', $stokOut->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

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
                                <div class="form-goup mb-3">
                                    <label for="produk_id" class="form-label">Nama Barang</label>
                                    <select class="form-select @error('produk_id') is-invalid @enderror" id="produk_id"
                                        name="produk_id" autofocus>
                                        <option value="" selected>Pilih Barang</option>
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->id }}"
                                                @if ($stokOut->produk_id == $produk->id) selected @endif>
                                                {{ $produk->nama_produk }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="qty" class="form-label">Jumlah Barang Keluar</label>
                                    <input type="number" id="qty" name="qty" placeholder="min = 1"
                                        class="form-control @error('qty') is-invalid @enderror"
                                        value="{{ old('qty', $stokOut->qty) }}" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pemohon" class="form-label">Pemohon</label>
                                    <input type="text" id="pemohon" name="pemohon"
                                        class="form-control @error('pemohon') is-invalid @enderror"
                                        value="{{ old('pemohon', $stokOut->pemohon) }}" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" rows="5" placeholder="Tambahkan keterangan">{{ old('keterangan', $stokOut->keterangan) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('stokOut.index') }}" name="kembali" class="btn btn-danger" id="back"><i
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
