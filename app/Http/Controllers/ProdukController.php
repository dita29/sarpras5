<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Tempat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $produks = Produk::orderBy('kategori_id', 'asc')->paginate(5);
        return view('admin.produk.index', compact('produks'))->with('no', 1);
    }

    public function create()
    {
        $tempats = Tempat::select('id', 'nama_tempat')->get();
        $kategoris = Kategori::select('id', 'nama_kategori')->get();
        return view('admin.produk.create', compact('kategoris', 'tempats'));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'nama_produk' => 'unique:produks|required',
                'kode_produk' => 'unique:produks,kode_produk|required|regex:/^\S*$/u',
                'kategori_produk' => 'required',
                'foto_produk' => 'image|mimes:jpeg,png,jpg,webp|file|max:2048',
            ],
            [
                'kode_produk.required' => 'Kode produk harus diisi',
                'kategori_produk' => 'Kategori produk harus diisi',
                'nama_produk.unique' => 'Nama produk ini sudah ada',
                'nama_produk.required' => 'Nama produk harus diisi',
                'kode_produk.unique' => 'Kode produk ini sudah ada',
                'kode_produk.regex' => 'Maaf kode produk tidak boleh ada spasi',
                'foto_produk.image' => 'Format foto produk yang dapat diinputkan adalah jpeg, png, jpg, dan webp',
                'foto_produk.file.max' => 'Maksimal ukuran foto yang dapat diinputkan adalah 2 Mb'
                // 'jml_produk' => 'Jumlah produk harus diisi',
            ]
        );

        if($request->file('foto_produk')){
            $img_name = time() . '_' . Str::title($request->nama_produk) . '.' . $request->foto_produk->extension();
            $request->foto_produk->storeAs('produk/', $img_name);
            $produk['foto_produk'] = $img_name;
        }

        $produk['nama_produk'] = Str::title($request->input('nama_produk'));
        $produk['kode_produk'] = strtoupper($request->input('kode_produk'));
        $produk['kategori_id'] = $request->input('kategori_produk');

        // dd($produk);
        Produk::create($produk);

        if (!$request) {
            toast('Produk gagal disimpan', 'error')->autoClose(1500);
            return redirect()->route('produk.create');
        } else {
            toast('Produk Berhasil disimpan', 'success')->autoClose(1500);
            return redirect()->route('produk.index');
        }

        return view('admin.produk.index');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.show', compact('produk'));
    }

    public function edit(Produk $produk, Kategori $kategori, $id)
    {
        $produk = Produk::findOrFail($id);

        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('admin.produk.edit', compact('produk', 'kategoris'));

        // dd($produk);
    }

    public function update(Request $request, Produk $produk, $id)
    {
        $produk = Produk::findOrFail($id);
        // $produk->delete();
        $request->validate(
            [
                'nama_produk' => 'required',
                'kode_produk' => 'required|regex:/^\S*$/u',
                'kategori_produk' => 'required',
                'foto_produk' => 'image|mimes:jpeg,png,jpg,webp|file|max:2048',
            ],
            [
                'nama_produk' => 'Nama produk harus diisi',
                'kode_produk' => 'Kode produk harus diisi',
                'kategori_produk' => 'Kategori produk harus diisi',
                'kode_produk.regex' => 'Maaf kode produk tidak boleh ada spasi',
                'foto_produk.image' => 'Format foto produk yang dapat diinputkan adalah jpeg, png, jpg, dan webp',
                'foto_produk.file.max' => 'Maksimal ukuran foto yang dapat diinputkan adalah 2 Mb'
            ]
        );

        if ($request->hasFile('foto_produk')) {

            $img_name = time() . '_' . $request->nama_produk . '.' . $request->foto_produk->extension();
            $request->foto_produk->storeAs('produk/', $img_name);

            Storage::delete('produk/' . $produk->foto_produk);

            $produk->update([
                'nama_produk' => $request->nama_produk,
                'kode_produk' => $request->kode_produk,
                'kategori_id' => $request->kategori_produk,
                'foto_produk' => $img_name,
            ]);
        } else {

            //update post without image
            $produk->update([
                'nama_produk' => $request->nama_produk,
                'kode_produk' => $request->kode_produk,
                'kategori_id' => $request->kategori_produk,
            ]);
        }

        if (!$request) {
            toast('Produk gagal disimpan', 'error')->autoClose(1500);
            return redirect()->route('produk.create');
        } else {
            toast('Produk Berhasil disimpan', 'success')->autoClose(1500);
            return redirect()->route('produk.index');
        }
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        Storage::delete('produk/' . $produk->foto_produk);
        $produk->delete();


        toast('Produk Berhasil Dihapus', 'success')->autoClose(1500);
        return redirect()->route('produk.index');
    }
}
