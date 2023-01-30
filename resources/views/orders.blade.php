@extends('layouts.admin') 

@section('content')
<br>
    <br>
        <br>
        <div class="container mt-2">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="row">
                    <div class="col-12  mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Orders</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Pesanan</th>
                                        <th>Id User</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $orders)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $orders->produk->nama }}</td>
                                        <td>{{ $orders->pesanan_id }}</td>
                                        <td>{{ $orders->pesanan->users_id }}</td>
                                        <td>{{ $orders->jumlah}}</td>
                                        <td>{{ $orders->jumlah_harga}}</td>
                                        <td>{{ $orders->pesanan->status}}</td>
                                        <td>
                                            <form action="{{ url('orders') }}\{{ $orders->id }}" method="Post">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin?')"><i class="fa fa-trash"></i> Delete</button>
                                                </td>
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