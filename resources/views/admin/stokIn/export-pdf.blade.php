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
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Penempatan</th>
                <th scope="col">Merk</th>
                <th scope="col">Harga</th>
                <th scope="col">Tanggal Barang</th>
                <th scope="col">Jumlah Barang Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->produk->nama_produk}}</td>
                    <td>{{ $data->tempat->nama_tempat }}</td>
                    <td>{{ $data->merk }}</td>
                    <td>{{ $data->harga_beli}}</td>
                    <td>{{ optional($data->tgl_beli)->isoFormat('dddd, DD MMMM Y')}}</td>
                    <td>{{ $data->qty}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
