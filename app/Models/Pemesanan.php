<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    
    public $timestamps = true;
    protected $table = "pemesanan";

    protected $guarded = [];

    public function products(){
        return $this->belongsTo(Products::class, 'product_id');
    }
}
