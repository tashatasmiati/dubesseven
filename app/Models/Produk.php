<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class produk extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'namaproduk', 'deskripsi',  'hargaproduk','slug'
    ];

    public function gallery()
    {
        return $this->hasMany(GalleryProduk::class, 'id_produk', 'id');
    }

}
