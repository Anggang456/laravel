<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\CloudinaryStorage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $data = Produk::all();
        return view('produk', compact('data'));
    }
    public function create(Request $request) {
        
        return view('create');
    }
    public function store(Request $request) {
        $image  = $request->file('gambar');
        $result = CloudinaryStorage::upload($image->getRealPath(), $image->getClientOriginalName()); 
        $data = Produk::create([
            'jenis' => $request->jenis,
            'nama' => $request->nama,
            'ukuran' => $request->ukuran,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'gambar' => $result
        ]);
       

        return redirect()->route('produk.index',compact('data'))->with(['success' => 'Data Berhasil Disimpan!']); 
    }
    public function edit(Produk $produk, Request $request) {
        return view('edit', compact('produk'));
    }
    public function update(Request $request, $id) {
        $data = Produk::find($id);
        $data->update($request->all());
        
        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Diubah!']);

    }
    public function destroy(Produk $produk) {
        $produk->delete();
        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
