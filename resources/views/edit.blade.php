@extends('layouts.admin') 

@section('content')
<br>
    <br>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded">
                        <div class="card-body">
                            <form
                                action="{{ route('produk.update', $produk->id) }}"
                                method="POST"
                                enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="form-group">
                                    <label class="font-weight-bold">Masukkan Jenis Batik :</label>
                                    <select
                                        id="jenis"
                                        name="jenis"
                                        class="form-control"
                                        value="{{ old('jenis', $produk->jenis) }}">
                                        <option selected>Pilih Jenis</option>
                                        <option value="Batik Cap">Batik Cap</option>
                                        <option value="Batik Tulis">Batik Tulis</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Masukkan Nama Batik :</label>
                                    <input
                                        name="nama"
                                        type="text"
                                        class="form-control"
                                        placeholder="Masukkan Nama"
                                        value="{{ old('nama', $produk->nama) }}">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Masukkan Ukuran Batik :</label>
                                    <select
                                        id="ukuran"
                                        class="form-control"
                                        value="{{ old('ukuran', $produk->ukuran) }}">
                                        <option selected>Pilih Ukuran</option>
                                        <option value="200 x 115">Batik Cap</option>
                                        <option value="215 x 215">Batik Tulis</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Masukkan Jumlah Stok :</label>
                                    <input
                                        name="stok"
                                        type="number"
                                        class="form-control"
                                        placeholder="Masukkan Jumlah Stok"
                                        value="{{ old('stok', $produk->stok) }}">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Masukkan Jumlah Harga :</label>
                                    <input
                                        name="harga"
                                        type="number"
                                        class="form-control"
                                        placeholder="Masukkan Jumlah Harga"
                                        value="{{ old('harga', $produk->harga) }}">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Masukkan Gambar Batik</label>
                                    <br>
                                    <tr>
                                        <td>
                                            <input type="file" name="gambar" id="gambar" class="form-control">
                                            <img
                                                src="{{ url($produk->gambar) }}"
                                                class="img-thumbnail"
                                                style="width: 50%;">
                                        </td>
                                    </tr>
                                </div>
                                <button type="submit" class="btn btn-md btn-primary" onclick="return confirm('Anda Yakin?')">CONFIRM</button>
                                <button type="reset" class="btn btn-md btn-warning">RESET</button>
                                <button type="back" class="btn btn-md btn-danger" href="{{ url('produk') }}">BACK</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection