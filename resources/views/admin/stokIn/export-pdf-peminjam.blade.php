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
                <th scope="col">ID</th>
                <th scope="col">Peminjam</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Kondisi Pinjam</th>
                <th scope="col">Tanggal Pinjam</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->id }}</td> <!-- ID -->
                    <td>{{ $data->peminjam }}</td> <!-- Peminjam -->
                    <td>{{ $data->produk->nama_produk }}</td> <!-- Nama Produk -->
                    <td>{{ $data->jumlah }}</td> <!-- Jumlah -->
                    <td>{{ $data->kondisi_pinjam }}</td> <!-- Kondisi Pinjam -->
                    <td>{{ $data->tgl_pinjam }}</td> <!-- Tanggal Pinjam -->
                    <td>{{ $data->status }}</td> <!-- Status -->
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
