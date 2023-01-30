<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    use HasFactory;
    public $table = 'pesanan_detail';
    protected $primaryKey = 'id';
    protected $fillable = ['id','produk_id','pesanan_id','jumlah','jumlah_harga'];


    public function Produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function Pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
    

}
