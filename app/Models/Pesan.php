<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['id_user', 'konten', 'balasan'];
}
