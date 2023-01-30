<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    public $table = 'produk';
    protected $primaryKey = 'id';
    protected $fillable = ['id','jenis','nama','ukuran','stok','harga','gambar'];

    public function PesananDetail()
    {
        return $this->hasMany(PesananDetail::class);
    }
    
    public function RiwayatPesanan()
    {
        return $this->belongsTo(RiwayatPesanan::class);
    }
}


