<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    public $table = 'pesanan';
    protected $primaryKey = 'id';
    protected $fillable = ['id','users_id','tanggal','status','jumlah_harga'];


    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function PesananDetail()
    {
        return $this->hasMany(PesananDetail::class);
    }

    public function RiwayatPesanan()
    {
        return $this->belongsTo(RiwayatPesanan::class);
    }

}
