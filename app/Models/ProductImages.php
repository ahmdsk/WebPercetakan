<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;
    protected $table = 'products_image';

    public function product(){
        return $this->belongsTo(Products::class);
    }
}
