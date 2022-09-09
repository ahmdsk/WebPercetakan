<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\KelolaPembayaran;
use App\Models\Products;
use App\Models\ProductImages;
use App\Models\ProductRatings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(){
        $data['web'] = [
            'title' => 'Lihat Produk',
            'breadcrumb' => [
                ['url' => '/products', 'name' => 'Kelola Produk'],
                ['url' => '/products', 'name' => 'Lihat Produk'],
            ],
        ];

        $data['products'] = Products::all();
        $data['category'] = Category::all();

        return view('admin.produk.index', $data);
    }

    public function store(Request $request){
        $product = $request->except(['_token']);

        $addProduct = Products::insert($product);
        if($addProduct){
            return back()->with('success', 'Produk Berhasil Ditambah');
        }else{
            return back()->with('error', 'Produk Gagal Ditambah');
        }
    }

    public function edit($id){
        $product = Products::find($id);
        return response()->json([
            'status' => 200,
            'data'   => $product
        ]);
    }

    public function update(Request $request, $id){
        $product = $request->except(['_token']);
        $updateProduct = Products::where('id', $id)->update($product);

        if($updateProduct){
            return back()->with('success', 'Produk Berhasil Diupdate');
        }else{
            return back()->with('error', 'Produk Gagal Diupdate');
        }
    }

    public function destroy($id){
        $category = Products::where('id', $id)->delete();
        
        if($category){
            return response()->json([
                "status" => 200
            ]);
        }
    }

    // gallery products
    public function galery($id){
        $data['web'] = [
            'title' => 'Galeri Produk',
            'breadcrumb' => [
                ['url' => '/products', 'name' => 'Kelola Produk'],
                ['url' => '/products', 'name' => 'Galeri Produk'],
            ],
        ];

        $data['product']        = Products::find($id);
        $data['gambar_product'] = ProductImages::where('products_id', $id)->get();

        return view('admin.produk.galeri', $data);
    }

    public function tambahGalery(Request $request){
        $gambarProduk = $request->validate([
            'products_id' => 'required',
            'jenis_gambar' => 'required',
            'gambar' => 'required|mimes:jpg,jpeg,png'
        ]);

        if($gambarProduk){
            // cek apakah sudah ada jenis gambar utama
            $cekGambar = ProductImages::where('products_id', $request->products_id)
                            ->where('jenis_gambar', 'gambar_utama')->first();

            if(empty($cekGambar) || $request->jenis_gambar == 'gambar_tambahan'){
                $gambar = rand().'.'.$request->file('gambar')->getClientOriginalExtension();
                $request->file('gambar')->move(public_path('/landing/img/products/'), $gambar);
    
                $gambarProduk = [
                    'products_id'   => $request->products_id,
                    'gambar'        => $gambar, 
                    'jenis_gambar'  => $request->jenis_gambar
                ];
                $tambahGambar = ProductImages::insert($gambarProduk);
    
                if($tambahGambar){
                    return back()->with('success', 'Berhasil Tambah Gambar Produk!');
                }else{
                    return back()->with('error', 'Gagal Tambah Gambar Produk!');
                }
            }else{
                return back()->with('warning', 'Maaf! Jenis Gambar Utama Sudah Ada');
            }

        }else{
            return back()->with('error', 'Gagal Tambah Gambar Produk!');
        }
    }

    public function editGalery($id){
        $product = ProductImages::find($id);
        return response()->json([
            'status' => 200,
            'data'   => $product
        ]);
    }

    public function updateGalery(Request $request){
        $gambar = $request->file('gambar');

        if($gambar != null){
            $gambarBaru = rand().'.'.$gambar->getClientOriginalExtension();
            $gambar->move(public_path('/galeri/'), $gambarBaru);

            $updateGaleri = DB::table('products_image')
                    ->where('products_id', $request->products_id)
                    ->update([
                        'gambar'       => $gambarBaru,
                        'jenis_gambar' => $request->jenis_gambar
                    ]);

            if($updateGaleri){
                return back()->with('success', 'Berhasil Edit Gambar!');
            }else{
                return back()->with('warning', 'Gagal Edit Gambar!');
            }
        }else{
            $updateGaleri = DB::table('products_image')
                    ->where('products_id', $request->products_id)
                    ->update([
                        'jenis_gambar' => $request->jenis_gambar
                    ]);

            if($updateGaleri){
                return back()->with('success', 'Berhasil Edit Jenis Gambar!');
            }else{
                return back()->with('warning', 'Gagal Edit Jenis Gambar!');
            }
        }
    }

    public function hapusGalery($id){
        $product = ProductImages::find($id)->delete();

        if($product){
            return response()->json(['status' => 200]);
        }
    }
    // end gallery product

    // semua produk
    public function semuaProduk(){
        $data['web'] = [
            'title' => 'List Semua Produk',
            'breadcrumb' => [
                ['url' => '/dashboard', 'name' => 'Dashboard'],
                ['url' => '/dashboard', 'name' => 'Dashboard'],
            ],
        ];

        $data['products'] = Products::all();

        return view('user.detailproduk.index', $data);
    }

    public function detailProduk($id){
        $data['produk'] = Products::find($id);
        $data['title'] = 'Detail Produk '.$data['produk']->product_name;

        $data['ulasan'] = DB::table('product_ratings')
                        ->join('users', 'users.id', '=', 'product_ratings.id_user')
                        ->where('id_product', $id)->get();

        $data['gambar'] = ProductImages::where('products_id', $id)->get();

        $totalRatings = DB::table('products')
            ->rightJoin('product_ratings', 'product_ratings.id_product', '=', 'products.id')
            ->where('id', $id)->get();
        
        $dataRatings = [];
        foreach($totalRatings as $tr){
            array_push($dataRatings, $tr->ratings);
        }

        if($dataRatings != null){
            $data['jumlah_rating'] = array_sum($dataRatings) / count($dataRatings);
        }else{
            $data['jumlah_rating'] = 0;
        }

        // cek data user ketika user telah memberi rating
        if(Auth::user()){
            $cekPesananUserLogin = DB::table('pemesanan')
                                ->where('user_id', Auth::user()->id)
                                ->where('product_id', $id)
                                ->get();

            if(count($cekPesananUserLogin) > 0){
                foreach($cekPesananUserLogin as $cekpesanan){
                    if($cekpesanan->status == 'Selesai'){
                        $cekUlasan = DB::table('product_ratings')
                                    ->where('id_user', Auth::user()->id)
                                    ->where('id_product', $id)
                                    ->first();
                        
                        if($cekUlasan){
                            $data['cekUlasan'] = 'sudah_mengulas';
                            $data['dataUlasan'] = $cekUlasan;
                        }else{
                            $data['cekUlasan'] = 'belum_mengulas';
                        }
                    }
                }
            }else{
                $data['cekUlasan'] = 'belum_pesan';
            }
        }

        return view('LandingPage.detailProduk', $data);
    }
    
    public function orderProduk(){
        $data['title'] = 'Order Produk';
        
        $data['rekening'] = KelolaPembayaran::all();
        $data['produk'] = DB::table('keranjang')
                    ->join('products', 'products.id', '=', 'keranjang.product_id')
                    ->select(
                        'products.id AS id_product', 'products.*',
                        'keranjang.id AS id_keranjang', 'keranjang.*',
                    )->where('user_id', Auth::user()->id)
                    ->where('product_stock', 'tersedia')
                    ->get();

        return view('LandingPage.order', $data);
    }

    public function orderProdukPost(Request $request){
        if($request->metode_pembayaran == 'transfer_lunas' || $request->metode_pembayaran == 'transfer_50'){
            $validate_buktiTf = $request->validate([
                'bukti_tf' => 'required|mimes:jpg,jpeg,png'
            ]);

            if($validate_buktiTf){
                $bukti_tf = $request->file('bukti_tf');
                $new_fileBukti = rand().'.'.$bukti_tf->getClientOriginalExtension();
                $bukti_tf->move(public_path('document/bukti/'), $new_fileBukti);

                $tambahOrderan = [];
                for ($i=0; $i < $request->jumlahProduk; $i++) {
                    array_push($tambahOrderan, DB::table('pemesanan')->insertGetId([
                        'user_id'       => Auth::user()->id,
                        'product_id'    => $request->id_produk[$i],
                        'kode_pesanan'  => 'TRX'.date('Ymd').'-'.rand(),
                        'status'        => 'Waiting',
                        'ket_pesanan'   => $request->keterangan[$i],
                        'metode_pembayaran' => $request->metode_pembayaran,
                        'jumlah_pesanan'    => $request->jumlah_produk[$i],
                        'harga_pesanan' 	=> $request->total_harga_produk[$i],
                        'bukti_pembayaran'  => $new_fileBukti,
                    ]));
                }

                if(!empty($tambahOrderan)){
                    $file_pesanan = $request->file('file_pesanan');
                    
                    // cek jumlah file pesanan
                    if($file_pesanan != null){
                        for ($f=0; $f < count($file_pesanan); $f++) {
                            $nama_file_baru = rand().'.'.$file_pesanan[$f]->getClientOriginalExtension();
                            $file_pesanan[$f]->move(public_path('document/cetak/'), $nama_file_baru);
                            
                        }

                        foreach ($tambahOrderan as $id) {
                            DB::table('files_cetak')->insert([
                                'id_pesanan'    => $id,
                                'file_name'     => $nama_file_baru
                            ]);
                        }

                        $hapusKeranjang = DB::table('keranjang')
                                    ->whereIn('id', $request->id_keranjang)
                                    ->delete();

                        if($hapusKeranjang){
                            return redirect('/pesanan')->with('success', 'Pesanan Berhasil!');
                        }else{
                            return back()->with('error', 'Pesanan Gagal!');
                        }
                    }else{
                        $hapusKeranjang = DB::table('keranjang')
                                    ->whereIn('id', $request->id_keranjang)
                                    ->delete();

                        if($hapusKeranjang){
                            return redirect('/')->with('success', 'Pesanan Berhasil!');
                        }else{
                            return back()->with('error', 'Pesanan Gagal!');
                        }
                    }
                }else{
                    return back()->with('error', 'Pesanan Gagal!');
                }
            }else{
                return back()->with('error', 'Silakan Upload Bukti Pembayaran!');
            }
        }else{
            $tambahOrderan = [];
                for ($i=0; $i < $request->jumlahProduk; $i++) {
                    array_push($tambahOrderan, DB::table('pemesanan')->insertGetId([
                        'user_id'       => Auth::user()->id,
                        'product_id'    => $request->id_produk[$i],
                        'kode_pesanan'  => 'TRX'.date('Ymd').'-'.rand(),
                        'status'        => 'Waiting',
                        'ket_pesanan'   => $request->keterangan[$i],
                        'metode_pembayaran' => $request->metode_pembayaran,
                        'jumlah_pesanan'    => $request->jumlah_produk[$i],
                        'harga_pesanan' 	=> $request->total_harga_produk[$i]
                    ]));
                }

                if(!empty($tambahOrderan)){
                    $file_pesanan = $request->file('file_pesanan');
                    
                    // cek jumlah file pesanan
                    if($file_pesanan != null){
                        for ($f=0; $f < count($file_pesanan); $f++) {
                            $nama_file_baru = rand().'.'.$file_pesanan[$f]->getClientOriginalExtension();
                            $file_pesanan[$f]->move(public_path('document/cetak/'), $nama_file_baru);
                            
                        }

                        foreach ($tambahOrderan as $id) {
                            DB::table('files_cetak')->insert([
                                'id_pesanan'    => $id,
                                'file_name'     => $nama_file_baru
                            ]);
                        }

                        $hapusKeranjang = DB::table('keranjang')
                                    ->whereIn('id', $request->id_keranjang)
                                    ->delete();

                        if($hapusKeranjang){
                            return redirect('/pesanan')->with('success', 'Pesanan Berhasil!');
                        }else{
                            return back()->with('error', 'Pesanan Gagal!');
                        }
                    }else{
                        $hapusKeranjang = DB::table('keranjang')
                                    ->whereIn('id', $request->id_keranjang)
                                    ->delete();

                        if($hapusKeranjang){
                            return redirect('/')->with('success', 'Pesanan Berhasil!');
                        }else{
                            return back()->with('error', 'Pesanan Gagal!');
                        }
                    }
                }else{
                    return back()->with('error', 'Pesanan Gagal!');
                }
        }
    }

    // fitur rating    
    public function beriUlasan(Request $request){
        $ulasan = ProductRatings::insert([
            'id_product'    => $request->id_produk,
            'id_user'       => Auth::user()->id,
            'ratings'        => $request->rating,
            'keterangan'    => $request->komentar
        ]);

        if($ulasan){
            return back()->with('success', 'Terimakasih Telah Memberikan Ulasan');
        }else{
            return back()->with('warning', 'Gagal Memberikan Ulasan!');
        }
    }

    public function editUlasan(Request $request){
        $ulasan = ProductRatings::where('id_rating', $request->id_ulasan)->update([
            'id_product'    => $request->id_produk,
            'id_user'       => Auth::user()->id,
            'ratings'        => $request->rating,
            'keterangan'    => $request->komentar
        ]);

        if($ulasan){
            return back()->with('success', 'Berhasil Edit Ulasan');
        }else{
            return back()->with('warning', 'Gagal Edit Ulasan!');
        }
    }
}
