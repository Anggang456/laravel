@extends('layouts.admin') 

@section('content')
<br>
    <br>
        <br>
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('produk.create') }}">
                        <i class="fa fa-plus"></i>
                            Tambah Data</a>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="row">
                    <div class="col-12  mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Products</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Jenis</th>
                                        <th>Nama</th>
                                        <th>Ukuran</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>Gambar</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $barang)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $barang->jenis?? 'Jenis Batik Tidak Ditemukan' }}</td>
                                        <td>{{ $barang->nama?? 'Nama Batik Tidak Ditemukan' }}</td>
                                        <td>{{ $barang->ukuran ?? 'Ukuran Tidak Ditemukan' }}
                                            cm</td>
                                        <td>{{ $barang->stok ?? 'Jumlah Stok Tidak Ditemukan'}}</td>
                                        <td>Rp
                                            {{ number_format ($barang->harga) ?? 'Jumlah Harga Tidak Ditemukan'}}</td>
                                        <td><img
                                            src="{{ url($barang->gambar) }}"
                                            width='50'
                                            height='50'
                                            class="img img-responsive"/></td>
                                        <td>
                                            <form action="{{ route('produk.destroy',$barang->id) }}" method="Post">
                                                <a class="btn btn-primary" href="{{ route('produk.edit',$barang->id) }}"><i class="fa fa-edit"></i> Edit</a>
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin?')"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>
</div>
            @endsection