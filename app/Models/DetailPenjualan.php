<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualan';

    protected $primaryKey = 'detailid';

    protected $fillable = [

        'penjualanid',
        'produkid',
        'jumlah_produk',
        'subtotal',
    ];


    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualanid');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produkid');
    }
}
