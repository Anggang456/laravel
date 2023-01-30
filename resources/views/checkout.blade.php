@extends('layouts.header') 
@section('content')
<div class="container bg-white rounded-top mt-3" >
    <div class="row d-flex justify-content-center">
        <div class="columns-lg-10 columns-12 pt-3">
            <div class="d-flex flex-column pt-4">
                <div class="border-bottom"><h5 class="text-uppercase font-weight-normal d5">My Cart</h5></div>
            </div>
            @foreach($pesanan_details as $details)
            <div class="d-flex flex-row justify-content-between align-items-center pt-4 pb-3 border-bottom mobile">
                <div class="d-flex flex-row align-items-center">
                    <div><img src="{{ $details->produk->gambar }}" width="150" height="150" alt="rounded" id="images"></div>
                    <div class="d-flex flex-column pl-md-3 pl-1">
                        <div><h6>{{ $details->produk->nama }}</h6></div>
                        <div >Id.No:<span class="pl-2">{{ $details->produk->id }}</span></div>
                        <div>Jenis:<span class="pl-3">{{ $details->produk->jenis }}</span></div>
                        <div>Ukuran:<span class="pl-4">{{ $details->produk->ukuran }} cm</span></div>
                        
                    </div>                    
                </div>
                <div class="pl-md-0 pl-1"><b></b></div>
                <div class="pl-md-0 pl-1"><b>Rp. {{ number_format($details->produk->harga) }}</b></div>
                <form method="post" action="{{ url('checkout') }}\{{ $details->id }}">
                    @csrf
                    {{ method_field('DELETE') }}
                <div class="close"><button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin ?')">
                    <i class="fa fa-trash"></i>
                    Hapus
                </button></div>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="container bg-secondary rounded-bottom py-4">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10 col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                   
                </div>
                <div class="px-md-0 px-1" id="footer-font">
                    <b class="pl-md-4">SUBTOTAL <span class="pl-md-4">Rp. {{number_format($details->jumlah_harga ?? '0') }}</span></b>
                </div>
                <div>
                    <button id="pay-button" class="btn btn-sm bg-dark text-white px-lg-5 px-3" onclick="return confirm('Pastikan Screenshot terlebih dahulu jika pembayaran menggunakan qode Qr!!')">CONTINUE</button>
                <form action="" id="submit_form" method="POST">
                    @csrf
                    <input type="hidden" name="json" id="json_callback">
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-d8KKygIlxas7LqVb"></script>
      <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

      
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
         console.log(result);
          send_response_to_form(result);
        },
        onPending: function(result){
          /* You may add your own implementation here */
          console.log(result);
          send_response_to_form(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
        console.log(result);
          send_response_to_form(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
    });
    
    function send_response_to_form(result) {
        document.getElementById('json_callback').value = JSON.stringify(result);
        $('#submit_form').submit();
    }
</script>
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@endsection