<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Produk::all();
        return view('home', compact('data'));
    }
    public function cart($id) {
        $data = Produk::where('id',$id)->first();
        $item = Produk::paginate('4');
        return view('cart');
    }
}
