@extends('layouts.header') 

@section('content')
<br>
<br>
<br>
<div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <table class="table table-bordered">
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Jumlah Harga</th>
                    <th>Action</th>
                </tr>
                @foreach($pesanan as $pesanan)
                <tr style="text-align: center;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pesanan->tanggal ?? '' }}</td>
                    <td>{{ $pesanan->status }}</td>
                    <td>Rp. {{ number_format($pesanan->jumlah_harga+$pesanan->kode) }}</td>
                    <td>
                        <a href="{{ url('history') }}/{{ $pesanan->id }}" class="btn btn-primary"><i class="fa fa-info"></i> Detail</a>
                    </td>
                </tr>
                @endforeach
            </table>
            
        </div>
    @endsection