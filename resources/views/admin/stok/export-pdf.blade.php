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
    <div class="container-fluid bg-danger text-center py-2 text-white">Laporan Sisa Stok Barang</div>
    <div class="container-fluid" style="margin-bottom: 50px">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Total Barang</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $data->nama_produk }}</td>
                        <td>{{ $data->kategori->nama_kategori }}</td>
                        <td>{{ $data->qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
