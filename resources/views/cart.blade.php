@extends('layouts.header') 

@section('content')
<div class="container px-4 px-lg-5 my-5">
    <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6">
            <img
                class="card-img-top mb-5 mb-md-0"
                src="{{ url($data->gambar)}}"
                alt="rounded"/>
        </div>
        <div class="col-md-6">
            <div class="small mb-1">STOK : {{ $data->stok }}</div>
            <h1 class="display-5 fw-bolder">{{ $data->nama }}</h1>
            <div class="fs-5 mb-5">
                
                <span>Rp. {{number_format($data->harga) }}</span>
            </div>
            <p class="lead" style="text-align: justify;">{{ $data->jenis }} {{ $data->nama }} dengan {{ $data->ukuran }} batik ini dibuat oleh pengrajin yang profesional batik ini batik asli dari banyuwangi.</p>
            <tr>
                <td>Jumlah Pesan</td>
                <td>:</td>
                <td>
                    <form method="post" action="{{ url('cart') }}/{{ $data->id ?? '' }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <button type="button" class="btn btn-outline-dark btn-number" disabled="disabled" data-type="minus" data-field="jumlah_pesan">
                                            <span class="fa fa-minus"></span>
                                        </button>
                                    </span>
                                        <input name="jumlah_pesan" class="form-control input-number" value="1" min="1" max="5">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-outline-dark btn-number" data-type="plus" data-field="jumlah_pesan">
                                        <span class="fa fa-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-outline-dark mt-2"
                            onclick="return confirm('Anda Yakin?')">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            Beli Sekarang
                        </button>
                    </form>
                </td>
            </tr>

        </div>
    </div>
</div>
</section>
<!-- Related items section-->
<section class="py-5 bg-light">
<div class="container px-4 px-lg-5 mt-5">
    <h2 class="fw-bolder mb-4">Related products</h2>

    <div
        class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        @foreach($item as $data)
        <div class="col mb-5">

            <div class="card h-100">
                <!-- Sale badge-->
                <!---<div class="badge bg-dark text-white position-absolute" style="top: 0.5rem;
                right: 0.5rem">Sale</div> -->
                <img
                    class="card-img-top"
                    src="{{ url($data->gambar) }}"
                    alt="rounded"/>
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">{{ $data->nama }}</h5>
                        <!-- Product reviews-->
                        <div class="d-flex justify-content-center small text-warning mb-2">
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                        </div>
                        <!-- Product price-->
                        <span class="text-muted">Rp.
                            {{ number_format ($data->harga) }}</span>
                    </div>
                </div>
                <!-- Product actions-->

                
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                        <a
                            class="btn btn-outline-dark mt-auto"
                            href="{{ url('cart') }}/{{ $data->id }}">Beli Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
});

$(".input-number").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) || 
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});
</script>
@endsection