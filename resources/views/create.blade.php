@extends('layouts.admin') 

@section('content')
<br>
    <br>
        <br>
        <div class="container mt-2">
            <div class="row">
            @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
            @endif
            <form
                action="{{ route('produk.store') }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Masukkan Jenis Batik:</strong>
                            <select name="jenis" class="form-control" value="jenis">
                                <option value="Batik Cap">Batik Cap</option>
                                <option value="Batik Tulis">Batik Tulis</option>
                            </select>
                            @error('jenis')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Masukkan Nama Batik :</strong>
                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                placeholder="Masukkan Nama Batik">
                            @error('nama')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Pilih Ukuran Batik :</strong>
                            <select name="ukuran" class="form-control" value="ukuran">
                                <option value="200 x 115">Batik Cap</option>
                                <option value="215 x 215">Batik Tulis</option>
                            </select>
                            @error('ukuran')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Masukkan Jumlah Stok :</strong>
                            <input
                                type="number"
                                name="stok"
                                class="form-control"
                                placeholder="Masukkan Jumlah Stok">
                            @error('stok')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Masukkan Harga Batik :</strong>
                            <input
                                type="number"
                                name="harga"
                                class="form-control"
                                placeholder="Masukkan Jumlah Harga">
                            @error('nama')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Masukkan Gambar Batik :</strong>
                        </div>
                        <input
                            type="file"
                            name="gambar"
                            class="form-control"
                            placeholder="Masukkan Gambar Batik">
                        @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="submit" class="btn btn-primary ml-3" onclick="return confirm('Anda Yakin?')">Submit</button>
                            <a class="btn btn-warning" href="{{ route('produk.index') }}">
                                Back</a>
                        </div>
                    </form>
               @endsection