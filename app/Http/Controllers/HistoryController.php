<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Auth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index() {
        $pesanan = Pesanan::where('users_id', Auth::user()->id)->where('status', '!=','unpaid')->get();
        return view('history', compact('pesanan'));
    }
    
    public function detail(Request $request,$id) {
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        

         
        return view('detail', compact('pesanan','pesanan_details'));
    }
}
