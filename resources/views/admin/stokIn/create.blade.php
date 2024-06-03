@extends('layouts.master')

@section('tab-title', 'Tambah Stok Barang | Admin')
@section('page-title', 'Tambah Stok Barang')
@section('contents')
    <div class="row">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Barang</h3>
                </div>
                <form action="{{ route('stokIn.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
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
                                <div class="form-goup mb-3">
                                    <label for="merk" class="form-label">Merk</label>
                                    <input type="text" id="merk" name="merk" style="text-transform: capitalize"
                                        class="form-control @error('merk') is-invalid @enderror"
                                        value="{{ old('merk') }}" />
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
                                        value="{{ old('tgl_beli') }}" />
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
                                                @if (old('nama_tempat') == $tempat->id)
                                                selected @endif>{{ $tempat->nama_tempat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('nama_tempat'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('nama_tempat') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="row mb-3">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Tambah Tempat
                                        </button>

                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="harga_beli" class="form-label">Harga Beli Barang</label>
                                    <input type="text" id="harga_beli" name="harga_beli"
                                        class="uang form-control @error('harga_beli') is-invalid @enderror"
                                        value="{{ old('harga_beli') }}" />
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
                                        value="{{ old('qty') }}" />
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
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('stokIn.index') }}" name="kembali" class="btn btn-danger"
                                    id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                                <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                                    Tambahkan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlaceModalLabel">Tambah Tempat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('tempat.store') }}">
                    <div class="modal-body">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="nama_tempat" class="form-label">Nama Tempat</label>
                            <input type="text" name="nama_tempat" id="nama_tempat" class="form-control" autofocus required>
                            @if ($errors->has('nama_tempat'))
                                <div class="alert alert-danger mt-2">
                                    <span class="text-danger mt-1">{{ $errors->first('nama_tempat') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col ms-auto">
                                <button type="button" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#showTempat">Show</button>
                            </div>
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Show -->
    <div class="modal fade" id="showTempat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tempat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50px">No</th>
                                <th scope="col">Nama Tempat</th>
                                <th style="width: 150px" scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tempats as $tempat)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $tempat->nama_tempat }}</td>
                                    <td>
                                        <form action="{{ route('tempat.destroy', $tempat->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger btn-flat show-alert-delete-box btn-sm btn-delete">Hapus</button>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    {{-- <div class="modal fade" id="editTempat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tempat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('tempat.update') }}">
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_tempat" class="form-label">Nama Tempat</label>
                                <input type="text" name="nama_tempat" id="nama_tempat" class="form-control"
                                value="{{ old('nama_tempat', $tempat->nama_tempat) }}" required autofocus>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success btn-sm">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

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
