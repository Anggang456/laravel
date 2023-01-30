@extends('layouts.welcome') 

@section('content')


@if ($message = Session::get('warning'))

            <div class="alert alert-danger">
                <h5 style="text-align: center;">{{ $message }}</h5>
            </div>
            @endif
            <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Neysha Batik</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Shop Hompeage</p>
                </div>
            </div>
        </header>
<section class="py-3">


    <div class="container px-4 px-lg-5 ">

        <div
            class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($data as $data)
            
            <div class="col mb-5">
                <span class="badge bg-dark text-white ms-auto"><strong>{{ $data->stok }}</strong></span>
                <div class="card h-100">

                    <!-- Product image-->
                    <img
                        class="card-img-top"
                        src="{{ url($data->gambar) }}"
                        alt="rounded"/>
                        
                   
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{ $data->nama }}</h5>
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            Rp. {{ number_format($data->harga) }}

                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a
                                class="btn btn-outline-dark flex-shrink-0"
                                href="{{ url('cart') }}/{{ $data->id }}">Beli Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection