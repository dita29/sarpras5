<?php

namespace App\Exports;

use App\Models\Pinjam;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;

class PeminjamanExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{

    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
{
    $loggedInUser = Auth::user(); // Mendapatkan objek pengguna yang sedang login

    // Pastikan pengguna sudah login sebelum mengakses nama
    $loggedInUserName = $loggedInUser ? $loggedInUser->name : null;

    return Pinjam::where('peminjam', $loggedInUserName)->get();
}

    public function headings(): array
    {
        return [
            'Kode Peminjaman',
            'Nama Peminjam',
            'Nama Barang',
            'Jumlah Peminjaman',
            'Kondisi',
            'Tanggal Pinjam',
            'Status Peminjaman',
        ];
    }

    public function map($produk): array {
        return [
            $produk->id,
            $produk->peminjam,
            $produk->produk->nama_produk,
            $produk->jumlah,
            $produk->kondisi_pinjam,
            $produk->tgl_pinjam,
            $produk->status,
        ];
    }
}
