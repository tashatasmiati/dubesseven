<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transaksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'users_id', 'pesan', 'pengirim', 'alamat_tujuan', 'tglkirim',
        'nohp', 'payment', 'payment_url', 'total_harga', 'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}





