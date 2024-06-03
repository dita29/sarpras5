@extends('layouts.master')

@section('tab-title', 'Edit Peminjaman | Admin')
@section('page-title', 'Edit Peminjaman')
@section('contents')
    <div class="row">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Pinjam</h3>
                </div>
                <form action="{{ route('peminjaman.update', $pinjam->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="kode_pinjam" class="form-label">Kode Peminjaman</label>
                                    <input type="text" id="kode_pinjam" name="kode_pinjam"
                                    readonly
                                        style="text-transform: capitalize"
                                        value="{{ old('status', $pinjam->id) }}"
                                        class="form-control @error('kode_pinjam') is-invalid @enderror" autofocus />
                                    @if ($errors->has('kode_pinjam'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('kode_pinjam') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="peminjam" class="form-label">Peminjam</label>
                                    <input type="text" id="peminjam" name="peminjam"
                                    readonly
                                        style="text-transform: capitalize"
                                        value="{{ old('status', $pinjam->peminjam) }}"
                                        class="form-control @error('peminjam') is-invalid @enderror" autofocus />
                                    @if ($errors->has('peminjam'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('peminjam') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_kembali" class="form-label">Tanggal Pengembalian</label>
                                    <input type="date" id="tgl_kembali" name="tgl_kembali"
                                        class="form-control @error('tgl_kembali') is-invalid @enderror"
                                        value="{{ old('tgl_kembali', optional($pinjam->tgl_kembali)->isoFormat('DD/MM/YYYY')) }}" />
                                    @if ($errors->has('tgl_kembali'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('tgl_kembali') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="status" class="form-label">Status Verifikasi</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="kosong">Pilih Verifikasi</option>
                                        <option value="Disetujui">Ditolak</option>
                                        <option value="Ditolak">Disetujui</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('peminjaman.index') }}" name="kembali" class="btn btn-danger" id="back"><i
                                class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                        <button name="submit" class="btn btn-primary" type="submit"><i class="nav-icon fas fa-save"></i> &nbsp;
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
