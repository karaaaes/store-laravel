<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    //
    protected $fillable = [
        'photos', 'products_id'
    ];

    protected $hidden = [];

    //Table Relasi
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');

        //Jika data dihapus tetapi masih bisa dilihat
        //return $this->hasMany(ProductGallery::class, 'products_id', 'id')->withTrashed();
    }
}
