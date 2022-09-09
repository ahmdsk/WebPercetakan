<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'product_name'      => 'Banner Fleksi',
            'product_price'     => 25000,
            'product_satuan'    => 'meter',
            'product_stock'     => 'tersedia',
            'category_id'       => 1
        ]);
    }
}
