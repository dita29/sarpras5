@extends('layouts.gurumaster')

@section('tab-title', 'Tambah Barang | Admin')
@section('page-title', 'Tambah Barang')
@section('contents')
    <script>
        const produkOptions = @json($produks);

        function ubahOtomatis() {
            const combobox = document.querySelector('#kategori_produksaya');
            const selectedValue = combobox.value;
            const selectedProduk = produkOptions.find(produk => produk.id === parseInt(selectedValue));

            // Mengisi nilai pada input dengan ID 'kategori_produk' dan 'kode_produk'
            document.querySelector('#kategori_produk').value = selectedProduk.nama_produk;
            document.querySelector('#kode_produk').value = selectedProduk.kode_produk;
            document.querySelector('#sisastok').value = selectedProduk.qty;
            document.querySelector('#foto_produk').src = "{{ Storage::url('produk/') }}" + selectedProduk.foto_produk;
        };

        function cekSisaStok() {
            const jumlahProduk = document.querySelector('#jumlahproduk');
            let sisaStok = parseInt(document.querySelector('#sisastok').value);
            let totalPinjam = parseInt(document.querySelector('#jumlahproduk').value);

            function isNonNegativeInteger(input) {
                // Regex untuk memeriksa apakah input merupakan bilangan bulat positif atau nol
                const regex = /^\d+$/;
                return regex.test(input);
            }

            if (totalPinjam > sisaStok || totalPinjam < 0) {
                document.querySelector('#btnsubmit').classList.add('disabled', 'btn-danger');
                document.querySelector('#btnsubmit').classList.remove('btn-primary');
                document.querySelector('#removable').classList.remove('d-none');
            } else {
                document.querySelector('#removable').classList.add('d-none');
                document.querySelector('#btnsubmit').classList.add('btn-primary');
                document.querySelector('#btnsubmit').classList.remove('disabled', 'btn-danger');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            // Panggil fungsi ubahOtomatis() saat halaman dimuat
            ubahOtomatis();

            // Tambahkan event listener untuk perubahan dropdown
            document.querySelector('#kategori_produksaya').addEventListener('change', ubahOtomatis);
        });
    </script>
    <div class="row">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Barang</h3>
                </div>
                <form action="{{ route('peminjamanguru.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_produk" class="form-label">Nama Barang</label>

                                    <select class="form-select @error('kategori_produk') is-invalid @enderror"
                                        id="kategori_produksaya" name="selected_label" onchange="ubahOtomatis()">
                                        <option value="" selected>Pilih Barang</option>
                                        @foreach ($produks as $barang)
                                            <option value="{{ $barang->id }}">{{ $barang->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('nama_produk'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('nama_produk') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="foto_produk" class="form-label">Foto Barang</label>
                                    <img src="{{ Storage::url('produk/') . $barang->foto_produk }}"
                                        class="card-img img-thumbnails" id="foto_produk"
                                        style="max-height: 150px; max-width: 150px; overflow-x: hidden; overflow-y: hidden">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kategori_produk" class="form-label">Kategori Barang</label>
                                    <input type="text" id="kategori_produk" name="kategori_produk"
                                        style="text-transform: uppercase" class="form-control" readonly />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kategori_produk" class="form-label">Sisa Stok</label>
                                    <input type="text" id="sisastok" name="sisa-stok" style="text-transform: uppercase"
                                        class="form-control" readonly />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kategori_produk" class="form-label">Total Pinjam</label>
                                    <input type="text" id="jumlahproduk" name="jumlah_produk"
                                        style="text-transform: uppercase" class="form-control" oninput="cekSisaStok()" />
                                    <h6 class="text-danger d-none" id="removable">Input Tidak Sesuai !!</h6>

                                </div>
                                <div class="form-group mb-3">
                                    <label for="kategori_produk" class="form-label">Kondisi Pinjam</label>
                                    <input type="text" id="kondisi_pinjam" name="kondisi_pinjam"
                                        style="text-transform: uppercase" class="form-control" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kode_produk" class="form-label">Kode Barang</label>
                                    <input type="text" id="kode_produk" name="kode_produk"
                                        style="text-transform: uppercase" class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('produk.index') }}" name="kembali" class="btn btn-danger" id="back"><i
                                class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                        <button name="submit" class="btn btn-primary" id="btnsubmit"><i class="nav-icon fas fa-save"></i>
                            &nbsp;
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
