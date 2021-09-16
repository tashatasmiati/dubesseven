<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itemtransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id', 'id_produk', 'id_transaksi'
    ];

    public function produk()
    {
        return $this->hasOne(Produk::class, 'id', 'id_produk');
    }
}
