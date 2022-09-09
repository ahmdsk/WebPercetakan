<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pemesanan;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductImages;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{
    // collaborative filtering method
    public function similarityDistance($preferences, $person1, $person2)
    {
        $similar = array();
        $sum = 0;

        foreach ($preferences[$person1] as $key => $value) {
            if (array_key_exists($key, $preferences[$person2]))
                $similar[$key] = 1;
            $nonsimilar[$key] = 0;
        }

        if (count($similar) == 0)
            return 0;

        foreach ($preferences[$person1] as $key => $value) {
            if (array_key_exists($key, $preferences[$person2]))
                $sum = $sum + pow($value - $preferences[$person2][$key], 2);
        }

        return  1 / (1 + sqrt($sum));
    }


    public function matchItems($preferences, $person)
    {
        $score = array();

        foreach ($preferences as $otherPerson => $values) {
            if ($otherPerson !== $person) {
                $sim = $this->similarityDistance($preferences, $person, $otherPerson);

                if ($sim > 0)
                    $score[$otherPerson] = $sim;
            }
        }

        array_multisort($score, SORT_DESC);
        return $score;
    }


    public function transformPreferences($preferences)
    {
        $result = array();

        foreach ($preferences as $otherPerson => $values) {
            foreach ($values as $key => $value) {
                $result[$key][$otherPerson] = $value;
            }
        }

        return $result;
    }


    public function getRecommendations($preferences, $person)
    {

        $total = array();
        $simSums = array();
        $ranks = array();
        $sim = 0;

        foreach ($preferences as $otherPerson => $values) {
            if ($otherPerson != $person) {
                $sim = $this->similarityDistance($preferences, $person, $otherPerson);
            }

            if ($sim > 0) {
                foreach ($preferences[$otherPerson] as $key => $value) {
                    if (!array_key_exists($key, $preferences[$person])) {
                        if (!array_key_exists($key, $total)) {
                            $total[$key] = 0;
                        }
                        $total[$key] += $preferences[$otherPerson][$key] * $sim;

                        if (!array_key_exists($key, $simSums)) {
                            $simSums[$key] = 0;
                        }
                        $simSums[$key] += $sim;
                    }
                }
            }
        }

        foreach ($total as $key => $value) {
            $ranks[$key] = $value / $simSums[$key];
        }

        // array_multisort($ranks, SORT_DESC);
        return $ranks;
    }
    // end collaborative filtering method



    public function getKategori(){
        $data['kategori'] = Category::all();

        return view('LandingPage._kategori', $data);
    }

    public function index(){
        $data_products   = DB::table('products')
                            ->leftjoin('products_image', 'products_image.products_id', '=', 'products.id')
                            ->select('products.id', 'products.product_name', 'products.product_price', 'products.category_id',
                                'products_image.gambar', 'products_image.jenis_gambar')
                            ->where('jenis_gambar', 'gambar_utama')
                            ->orWhereNull('jenis_gambar')->get();

        $data['latest_product'] = [];
        foreach($data_products as $p){
            $dataRating = DB::table('product_ratings')->where('id_product', $p->id)->pluck('ratings');
            
            if(count($dataRating) > 0){
                array_push($data['latest_product'], [
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
                array_push($data['latest_product'], [
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

        // data collaborative filtering
        // semua userr
        $users = DB::table('users')->where('role', 'user')->get();

        // user yang telah login
        $userLogin = Auth::user();
        
        // cek pesanan user yang telah login
        if($userLogin){
            $cekPesananUserLogin = Pemesanan::where('user_id', $userLogin->id)->get();
        }else{
            $cekPesananUserLogin = [];
        }


        $data['rekomendasi'] = [];
        $dataRekomendasi = [];
        if(count($cekPesananUserLogin) > 0){
            foreach($users as $u){
                $pesanan = Pemesanan::where('user_id', $u->id)->with('products')->get();
                foreach($pesanan as $psn){
                    $rating = DB::table('product_ratings')
                            ->where('id_product', $psn->products->id)
                            ->where('id_user', $u->id)
                            ->select('ratings')->pluck('ratings')->first();
    
                    $dataRekomendasi[$u->id][$psn->products->id] = $rating;
                }
            }

            $rekomendasi = $this->getRecommendations($dataRekomendasi, $userLogin->id);

            foreach($rekomendasi as $idProduk => $rating){
                $produkRekomendasi   = DB::table('products')
                            ->leftjoin('products_image', 'products_image.products_id', '=', 'products.id')
                            ->select('products.id', 'products.product_name', 'products.product_price', 'products.category_id',
                            'products_image.gambar', 'products_image.jenis_gambar')
                            ->where('products.id', $idProduk)
                            ->where('jenis_gambar', 'gambar_utama')
                            ->orWhereNull('jenis_gambar')->get();

                foreach($produkRekomendasi as $pr){
                    $dataRating = DB::table('product_ratings')->where('id_product', $pr->id)->pluck('ratings');
                
                    if(count($dataRating) > 0){
                        array_push($data['rekomendasi'], [
                            'id'            => $pr->id,
                            'product_name'	=> $pr->product_name,
                            'product_price'	=> $pr->product_price,
                            'category_id'   => $pr->category_id,
                            'gambar'	    => $pr->gambar,
                            'jenis_gambar'	=> $pr->jenis_gambar,
                            'jumlah_rating' => [
                                'rating'    => array_sum(DB::table('product_ratings')->where('id_product', $pr->id)->pluck('ratings')->toArray()) / DB::table('product_ratings')->where('id_product', $pr->id)->count()
                            ]
                        ]);
                    }else{
                        array_push($data['rekomendasi'], [
                            'id'            => $pr->id,
                            'product_name'	=> $pr->product_name,
                            'product_price'	=> $pr->product_price,
                            'category_id'   => $pr->category_id,
                            'gambar'	    => $pr->gambar,
                            'jenis_gambar'	=> $pr->jenis_gambar,
                            'jumlah_rating' => [
                                'rating'    => 0
                            ]
                        ]);
                    }
                }
            }
        }else{
            $rekomendasi = [];
        }
        // end data collaborative filtering

        return view('LandingPage.index', $data);
    }

    public function detailKategori($slug){
        $data['title']    = 'Detail Kategori Produk';
        $data['category'] = Category::where('category_slug', $slug)->first();

        $data_products   = DB::table('products')
                            ->leftjoin('products_image', 'products_image.products_id', '=', 'products.id')
                            ->select('products.id', 'products.product_name', 'products.product_price', 'products.category_id',
                                'products_image.gambar', 'products_image.jenis_gambar')
                            ->where('category_id', $data['category']->id)
                            ->where('jenis_gambar', 'gambar_utama')
                            ->orWhereNull('jenis_gambar')
                            ->get();

        $data['products'] = [];
        foreach($data_products as $p){
            $dataRating = DB::table('product_ratings')->where('id_product', $p->id)->pluck('ratings');

            if(count($dataRating) > 0){
                array_push($data['products'], [
                    'id_product'    => $p->id,
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
                array_push($data['products'], [
                    'id_product'    => $p->id,
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
        
        return view('LandingPage.detailKategori', $data);
    }
}
