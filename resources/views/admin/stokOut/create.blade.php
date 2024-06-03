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
                <form action="{{ route('stokOut.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">

                                </div>
                                <div class="form-goup mb-3">
                                    <label for="produk_id" class="form-label">Nama Barang</label>
                                    <select class="form-select @error('produk_id') is-invalid @enderror" id="produk_id"
                                        name="produk_id" autofocus>
                                        <option value="">Pilih Barang</option>
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->id }}"
                                                @if (old('produk_id') == $produk->id )
                                                selected @endif>{{ $produk->nama_produk }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('produk_id'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('produk_id') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="qty" class="form-label">Jumlah Barang Keluar</label>
                                    <input type="number" id="qty" name="qty" placeholder="min = 1" min="1"
                                        class="form-control @error('qty') is-invalid @enderror"
                                        value="{{ old('qty') }}" />
                                    @if ($errors->has('qty'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('qty') }}</span>
                                        </div>
                                    @endif
                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-danger alert-block">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pemohon" class="form-label">Pemohon</label>
                                    <input type="text" id="pemohon" name="pemohon" style="text-transform: capitalize"
                                        class="form-control @error('pemohon') is-invalid @enderror"
                                        value="{{ old('pemohon') }}" />
                                    @if ($errors->has('pemohon'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('pemohon') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" rows="5" placeholder="Tambahkan keterangan">{{ old('keterangan') }}</textarea>
                                    @if ($errors->has('keterangan'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('keterangan') }}</span>
                                        </div>
                                    @endif
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
