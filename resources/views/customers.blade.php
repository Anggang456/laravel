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
                            <h5 class="card-header">Customers</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Telp</th>
                                        <th>Alamat</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($customers as $customers)
                                    <tr>
                                        <th scope="row">{{ $customers->id }}</th>
                                        <td>{{ $customers->name }}</td>
                                        <td>{{ $customers->email }}</td>
                                        <td>{{ $customers->no_telp }}</td>
                                        <td>{{ $customers->alamat}}</td>
                                        <td>
                                            <form action="{{ url('customers') }}\{{ $customers->id }}" method="Post">
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