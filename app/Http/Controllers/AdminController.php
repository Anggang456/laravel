<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Carbon\Carbon;
use Auth;

class AdminController extends Controller
{
    public function index() {
        $tanggal = Carbon::now();
        $data = User::count();
        $last_transaction = PesananDetail::paginate(4);

        
        
        $dateFrom = Carbon::now()->subDays(30);
        $dateTo = Carbon::now();
        $monthly = User::whereBetween('created_at', [$dateFrom, $dateTo])->count();
        $total = Pesanan::whereBetween('created_at', [$dateFrom, $dateTo])->sum('jumlah_harga');
        $purchases = Pesanan::whereBetween('created_at', [$dateFrom, $dateTo])->count();
        $total_produk = Produk::whereBetween('created_at', [$dateFrom, $dateTo])->count();

        $previousDateFrom = Carbon::now()->subDays(60);
        $previousDateTo = Carbon::now()->subDays(31);
        $previousMonthly = User::whereBetween('created_at', [$dateFrom,$dateTo])->count();

        if($previousMonthly < $monthly){
            if($previousMonthly >0){
                $percent_from = $monthly - $previousMonthly;
                $percent = $percent_from / $previousMonthly * 100; //increase percent
            }else{
                $percent = 100; //increase percent
            }
        }else{
            $percent_from = $previousMonthly -$monthly;
            $percent = $percent_from / $previousMonthly * 100; //decrease percent
        }

        return view('dashboard', compact('data','tanggal','monthly','total','purchases','last_transaction','total_produk'));
    }
    public function orders() {
        $orders = PesananDetail::all();
        return view('orders', compact('orders'));
    }
    public function orders_delete($id) {
        $pesanan_detail = PesananDetail::where('id', $id)->first();
        $pesanan_detail->delete();
        Pesanan::where('id', $pesanan_detail->pesanan_id)->delete();
        return redirect('orders');
    }
    public function customers(){
        $customers = User::all();
        return view('customers',compact('customers'));
    }
    public function customers_delete($id){
        $customers = User::where('id',$id);
        $customers->delete();
        return view('customers');
    }
}
