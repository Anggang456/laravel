<?php

namespace App\Http\Controllers\API;
use App\Models\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index() {
        $produk = Produk::all();
        return response()->json([
            'data' => $produk
        ]);
    }

    public function store(Request $request) {
        $produk = Produk::create([
            'jenis' => $request->jenis,
            'nama' => $request->nama,
            'ukuran' => $request->ukuran,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $request->gambar
        ]);
        
        return response()->json([
            'data' => $produk
        ]);
    }

    public function show(Produk $produk) {
        return response()->json([
            'data' => $produk
        ]);
    }

    public function update(Request $request,Produk $produk) {
        $produk->jenis = $request->jenis;
        $produk->nama = $request->nama;
        $produk->ukuran = $request->ukuran;
        $produk->stok = $request->stok;
        $produk->harga = $request->harga;
        $produk->gambar = $request->gambar;
        $produk->save();

        return response()->json([
            'data' => $produk
        ]);
    }

    public function delete(Produk $produk) {
        $produk->delete();

        return response()->json([
            'message' => 'Produk di hapus'
        ], 204);
    }
}
