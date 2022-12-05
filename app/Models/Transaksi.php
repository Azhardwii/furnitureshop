<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['id_produk', 'tgl_transaksi', 'jumlah', 'harga', 'id_customer'];
}
