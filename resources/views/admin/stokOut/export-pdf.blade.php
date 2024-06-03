<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid bg-danger text-center py-2 text-white">Riwayat Transaksi</div>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jumlah Produk Keluar</th>
                <th scope="col">Tanggal Keluar</th>
                <th scope="col">Pemohon</th>
                <th scope="col">Status</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->produk->nama_produk }}</td>
                    <td>{{ $data->jumlah }}</td>
                    <td>{{ $data->tgl_pinjam->format('d-m-Y')}}</td>
                    <td>{{  $data->peminjam }}</td>
                    <td>{{  $data->status }}</td>
                    <td>{{  $data->kondisi_pinjam }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex flex-row-reverse" style="padding-right: 15px; width: 100%;">
        <div style="margin: 10px; text-align:right">
             {{ optional(now())->isoFormat('dddd, DD MMMM Y') }}
        </div>
        <div style="margin: 10px; text-align:right; margin-bottom: 55px">
            Administrator Sarana Prasarana
        </div>
        <div style="margin: 10px; text-align:right;  padding-right: 25px;">
            Andri Prasetyo
        </div>
    </div>
</body>

</html>
