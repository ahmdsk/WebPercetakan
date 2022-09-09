<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'product_name', 'product_price', 'product_desc', 'product_stock', 'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function pemesanan(){
        return $this->hasMany(Pemesanan::class);
    }

    public function productImages(){
        return $this->hasMany(ProductImages::class);
    }

    public function productRating(){
        return $this->hasOne(ProductRatings::class);
    }
}