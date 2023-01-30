<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $data = Produk::all();
        return view('welcome', compact('data'));
    }
}
