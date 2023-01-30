<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Auth;
use Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id) {
        $data = Produk::where('id',$id)->first();
        $item = Produk::paginate('4');
        
    
        return view('cart',  compact('data','item'));

    }

    public function pesan(Request $request, $id) {
        $data = Produk::where('id',$id)->first();
        $tanggal = Carbon::now();
        
        if(empty($data->stok)) {
            return redirect('out');
        }
        if($request->jumlah_pesan > $data->stok)
            {
                return redirect('cart/.$id');
            }

        $cek_pesanan = Pesanan::where('users_id', Auth::user()->id)->where('status','unpaid')->first();
        //simpan database pesanan
        if(empty($cek_pesanan))
            {
                $pesanan = new Pesanan;
                $pesanan->users_id = Auth::user()->id;
                $pesanan->tanggal = $tanggal;
                $pesanan->status = 'unpaid';
                $pesanan->kode = mt_rand(100,999);
                $pesanan->jumlah_harga = 0;
                $pesanan->save();
            }

        

        //simpan ke database pesanan_detail
        $pesanan_baru = Pesanan::where('users_id', Auth::user()->id)->where('status','unpaid')->first();
        
        $cek_pesanan_detail = PesananDetail::where('produk_id', $data->id,)->where('pesanan_id', $pesanan_baru->id)->first();

        if(empty($cek_pesanan_detail))
            {
                $pesanan_detail = new PesananDetail;
                $pesanan_detail->produk_id = $data->id;
                $pesanan_detail->pesanan_id = $pesanan_baru->id;
                $pesanan_detail->jumlah = $request->jumlah_pesan;
                $pesanan_detail->jumlah_harga = $data->harga*$request->jumlah_pesan;
                $pesanan_detail->save();
            }else
            {
                $pesanan_detail = PesananDetail::where('produk_id', $data->id,)->where('pesanan_id', $pesanan_baru->id)->first();
                $pesanan_detail = new PesananDetail;
                $pesanan_detail->jumlah = $pesanan_detail->jumlah+$request->jumlah_pesan;
                $harga_pesanan_detail_baru = $data->harga*$request->jumlah_pesan;
                $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+$harga_pesanan_detail_baru;
                $pesanan_detail->update();
            }
        
        $pesanan = Pesanan::where('users_id', Auth::user()->id)->where('status','unpaid')->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$data->harga*$request->jumlah_pesan;
        $pesanan->update();

        Alert::success('Pesanan Sukses Masuk Keranjang', 'Success');
        return redirect('checkout');

    }

    public function checkout(Request $request) {
        
        $pesanan = Pesanan::where('users_id', Auth::user()->id)->where('status','unpaid')->first();
        $pesanan_details = collect();
        if(empty($pesanan))
        {
            return redirect('empty');
              
        }else{
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get(); 
        }
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => $pesanan->id,
                'gross_amount' => $pesanan->jumlah_harga,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => '08111222333',
            ),
        );
        if(empty($pesanan->jumlah_harga)){
            return redirect('empty');
        }
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        if(empty($user->alamat))
        {
            Alert::error('Identitasi Harap dilengkapi', 'Error');
            return redirect('profile');
        }

        if(empty($user->no_telp))
        {
            Alert::error('Identitasi Harap dilengkapi', 'Error');
            return redirect('profile');
        }
        return view('checkout', compact('pesanan','pesanan_details','snapToken'));
    }

    public function delete($id) {
        $pesanan_detail = PesananDetail::where('id', $id)->first();

        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga-$pesanan_detail->jumlah_harga;
        $pesanan->update();
        $pesanan_detail->delete();

        Alert::success('Pesanan Sukses Dihapus', 'Hapus');
        return redirect('checkout');
    }


    public function payment_post(Request $request) {
        $json = json_decode($request->get('json'));
        $user = User::where('id', Auth::user()->id)->first();

        if(empty($user->alamat))
        {
            Alert::error('Identitasi Harap dilengkapi', 'Error');
            return redirect('profile');
        }

        if(empty($user->no_telp))
        {
            Alert::error('Identitasi Harap dilengkapi', 'Error');
            return redirect('profile');
        }
        $pesanan = Pesanan::where('users_id', Auth::user()->id)->where('status','unpaid')->first();
        
        
        $pesanan_id = $pesanan->id;
        if(empty($pesanan_id)){
            return redirect('checkout');
        }else {
            $pesanan->status = $json->transaction_status;
        }
        $pesanan->update() ?? redirect(url('checkout'));
        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
        foreach ($pesanan_details as $pesanan_detail) {
            $data = Produk::where('id', $pesanan_detail->produk_id)->first();
            $data->stok = $data->stok-$pesanan_detail->jumlah;
            $data->update();
            
        }

        Alert::success('Pesanan Sukses Check Out', 'Success');
        return redirect('history/'.$pesanan_id);
    }

    public function empty(){
        return view('empty');
    }

    public function out(){
        return view('out');
    }
}
