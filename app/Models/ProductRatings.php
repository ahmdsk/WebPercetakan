<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRatings extends Model
{
    use HasFactory;
    protected $table = 'product_ratings';

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function products(){
        return $this->belongsTo(Products::class, 'id_product');
    }
}
