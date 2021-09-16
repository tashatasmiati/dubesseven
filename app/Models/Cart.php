<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id', 'id_produk'
    ];

    public function produk(){
        return $this->hasOne(Produk::class, 'id', 'id_produk');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
