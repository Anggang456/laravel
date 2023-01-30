@extends('layouts.header') 

@section('content')
    <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
           
            @endif
            <div class="col-md-13">
                <div class="card">
                    <div class="card-body">
                        <h3>Pesanan {{ $pesanan->status }}</h3>
                        
                            dengan nominal : 

                            <strong>Rp. {{ number_format($pesanan->kode+$pesanan->jumlah_harga) }}</strong>
                            <h6>Silahkan hubungi <b>081249690732</b> jika terjadi kesalahan!!!</h6>
                        </h5>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                    <div class="col-12  mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Check-out</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                    <thead>
                                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pesanan_details as $pesanan_detail)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $pesanan_detail->produk->nama }}</td>
                    <td>{{ $pesanan_detail->jumlah }} Produk</td>
                    <td>Rp. {{ number_format($pesanan_detail->produk->harga) }}</td>
                    <td>Rp. {{ number_format($pesanan_detail->jumlah_harga) }}</td>
                </tr>
                @endforeach
                </tbody>
                
            </table>
        </div>
        <div class="container text-right">
            <div class="row">
                <div class="col">
                    <h5 style="text-align: right;">Rp.
                        {{ number_format ($pesanan->jumlah_harga ?? '0') }}</h5>
                </div>
        
            </div>
    </div>
    </div>
    
</div>
</div>

            

           
@endsection