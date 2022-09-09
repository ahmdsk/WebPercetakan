<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pemesanan;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $data['web'] = [
            'title' => 'Dashboard',
            'breadcrumb' => [
                ['url' => '/dashboard', 'name' => 'Dashboard'],
                ['url' => '/dashboard', 'name' => 'Dashboard'],
            ],
        ];

        $data['costumer'] = User::where('role', 'user')->count();
        $data['products'] = Products::all()->count();
        $data['orders']   = Pemesanan::all()->count();
        $data['pendapatan'] = DB::table('pemesanan')->where('status', 'Selesai')->sum('harga_pesanan');

        return view('home', $data);
    }

    public function getCategoryUser(){
        $data['category'] = Category::all();
        return view('user.getCategoryUser', $data);
    }

    // setting perusahaan
    public function settingperusahan(){
        $data['web'] = [
            'title' => 'Setting Perusahaan',
            'breadcrumb' => [
                ['url' => '/dashboard', 'name' => 'Dashboard'],
                ['url' => '#', 'name' => 'Setting Perusahaan'],
            ],
        ];

        $data['perusahaan'] = DB::table('perusahaan')->first();

        return view('admin.perusahaan.index', $data);
    }

    public function ubahprofile(Request $request){
        if ($request->file('logo') != null) {
            $request->validate([
                'logo' => 'mimes:jpg,jpeg,png'
            ]);

            $logo = $request->file('logo');
            $new_logo = rand() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('landing/img/logo/'), $new_logo);

            $ubahProfile = ['logo' => $new_logo];
        } else {
            $ubahProfile = [
                'nama_perusahaan'     => $request->nama_perusahaan,
                'no_telp_perusahaan'  => $request->no_telp,
                'email_perusahaan'    => $request->email,
                'deskripsi'           => $request->deskripsi,
                'alamat'              => $request->alamat,
            ];
        }

        $profile = DB::table('perusahaan')
            ->where('id_perusahaan', $request->id_perusahaan)
            ->update($ubahProfile);

        if ($profile) {
            return back()->with('success', 'Profile Perusahaan Berhasil Diubah!');
        } else {
            return back()->with('error', 'Gagal Ubah Profile Perusahaan!');
        }
    }

    // search bar
    public function cariProduk(Request $request){
        $data_products   = DB::table('products')
                        ->leftjoin('products_image', 'products_image.products_id', '=', 'products.id')
                        ->select(
                            'products.id',
                            'products.product_name',
                            'products.product_price',
                            'products.category_id',
                            'products_image.gambar',
                            'products_image.jenis_gambar'
                        )->where('product_name', $request->p)
                        ->orWhere('product_name', 'like', '%'.$request->p.'%')
                        ->where('jenis_gambar', 'gambar_utama')
                        ->orWhereNull('jenis_gambar')
                        ->get();

        $data['produk'] = [];
        foreach ($data_products as $p) {
            $dataRating = DB::table('product_ratings')->where('id_product', $p->id)->pluck('ratings');
            
            if(count($dataRating) > 0){
                array_push($data['produk'], [
                    'id'            => $p->id,
                    'product_name'	=> $p->product_name,
                    'product_price'	=> $p->product_price,
                    'category_id'   => $p->category_id,
                    'gambar'	    => $p->gambar,
                    'jenis_gambar'	=> $p->jenis_gambar,
                    'jumlah_rating' => [
                        'rating'    => array_sum(DB::table('product_ratings')->where('id_product', $p->id)->pluck('ratings')->toArray()) / DB::table('product_ratings')->where('id_product', $p->id)->count()
                    ]
                ]);
            }else{
                array_push($data['produk'], [
                    'id'            => $p->id,
                    'product_name'	=> $p->product_name,
                    'product_price'	=> $p->product_price,
                    'category_id'   => $p->category_id,
                    'gambar'	    => $p->gambar,
                    'jenis_gambar'	=> $p->jenis_gambar,
                    'jumlah_rating' => [
                        'rating'    => 0
                    ]
                ]);
            }
        }
        
        return view('LandingPage.cari', $data);
    }
}
