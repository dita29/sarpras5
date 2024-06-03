@extends('layouts.master')

@section('tab-title', 'Kategori | Admin')
@section('page-title', 'Kategori')
@section('contents')
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h4 class="card-title">Tambah Kategori</h4>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('kategori.create') }}" class="btn btn-success">Tambah Kategori</a>
                            </div>
                            {{-- <div class="col-auto">
                                <input type="text" name="keyword" class="form-control"
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
                                <th scope="col">Kode Kategori</th>
                                <th scope="col">Nama Kategori</th>
                                <th style="width: 150px" scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datas as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->kode_kategori }}</td>
                                    <td>{{ $data->nama_kategori }}</td>
                                    <td>
                                        <form action="{{ route('kategori.destroy', $data->id) }}" method="POST">
                                            <a href="{{ route('kategori.edit', $data->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            {{-- <button type="submit" class="btn btn-sm btn-danger">Hapus</button> --}}
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit"
                                                class="btn btn-sm btn-danger btn-flat show-alert-delete-box btn-sm btn-delete"
                                                data-toggle="tooltip" title='Delete'>Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Kategori belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-fex mt-2">
            {!! $datas->links() !!}
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
