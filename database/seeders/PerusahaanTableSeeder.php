<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerusahaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perusahaan')->insert([
            'nama_perusahaan'       =>  'GRIYA PRINTING',
            'no_telp_perusahaan'    =>  '+62812345678',
            'email_perusahaan'      =>  'email@tes.com',
            'alamat'                =>  'Bandar Lampung, Jalan Kelinci Gg Harimau No 99',
            'deskripsi'             =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur dolorem cumque vel, itaque, cupiditate natus ex ratione pariatur praesentium dolor distinctio voluptas quisquam inventore illo quaerat qui, consequatur esse totam!',
            'logo'                  =>  'Logo.png'
        ]);
    }
}
