<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RekomendasiController2 extends Controller
{
    public function rekomendasi(){
        // mendapatkan id user yang sedang login
        $user = Auth::user()->id;

        // mendapatkan pesanan user yang berbeda beda
        $pesananUser = DB::table('pemesanan')->distinct('user_id')->get();
        
        // mendapatkan pesanan user berdasarkan id usernya
        $userExist   = DB::table('pemesanan')->where('user_id', $user)->get();

        $hasil_userExist = [];
        foreach($userExist as $r){
            array_push($hasil_userExist, $r->id);
        }

        // matriks penampung rating dari transaksi user
        $fullProduk = [];

        // dimensi pertama = mengisi id user
        foreach($pesananUser as $pu){
            $id_user = $pu->user_id;

            $pesananProdukUser = DB::table('pemesanan')
                        ->join('product_ratings', 'product_ratings.id_product', '=', 'pemesanan.product_id')
                        ->selectRaw('product_id, user_id, round(avg(ratings), 1) as rata_rating')
                        ->where('user_id', $id_user)
                        ->groupBy('product_id', 'user_id')
                        ->get();

            $produkArray = [];
            foreach($pesananProdukUser as $ppu){
                $produkArray[$ppu->product_id] = $ppu->rata_rating;
            }
            
            $fullProduk[$id_user] = $produkArray;
        }

        // return $fullProduk;
        // transpos matriks data rating
        $fullProdukTranspos = [];
        foreach($fullProduk as $key => $fp){
            foreach($fp as $k => $fpx){
                $fullProdukTranspos[$k][$key] = $fpx;
            }
        }

        // return $this->getSimilarities($fullProduk);
        $cekSimilar = $this->getSimilarities($fullProduk);
        foreach($cekSimilar as $ks => $cs){
            if($ks == $user){
                return $this->main($user, $this->getSimilarities($fullProduk), $fullProduk);
            }else{
                return response()->json([
                    $user => ['hasil' => 0]
                ]);
            }
        }
    }


    public function getSimilarities($fullProduk){
        $rata = $this->getRata($fullProduk);
        $hasil = [];

        foreach($fullProduk as $k1 => $v1){
            foreach($fullProduk as $k2 => $v2){
                $subhasil = 0;

                if($k1 != $k2){
                    $atas   = $this->atas($k1, $k2, $rata, $v1, $v2);
                    $bawah  = $this->bawah($k1, $k2, $rata, $v1, $v2);

                    if($bawah != 0){
                        $subhasil = $atas/$bawah;
                    }else{
                        $subhasil = 0;
                    }

                    $hasil[$k1][$k2] = $subhasil;
                }
            }
        }

        return $hasil;
    }

    public function getRata($produk){
        $rata = [];

        foreach ($produk as $key => $value) {
            $total = 0;
            foreach ($value as $k => $v) {
                $total += $v;
            }
            $rata[$key] = $total/sizeof($value);
        }

        return $rata;
    }

    public function atas($produk1, $produk2, $rata, $member1, $member2){
        $total = 0;
        foreach($member1 as $k1 => $p1){
            foreach($member2 as $k2 => $p2){
                if($k1 == $k2){
                    $total+=($p1 - $rata[$produk1])*($p2 - $rata[$produk2]);
                }
            }
        }

        return $total;
    }

    public function bawah($produk1, $produk2, $rata, $member1, $member2){
        $totalProduk1 = 0;
        $totalProduk2 = 0;

        foreach($member1 as $k1 => $p1) {
            foreach($member2 as $k2 => $p2){
                if($k1 == $k2){
                    $totalProduk1 += pow($p1 - $rata[$produk1], 2);
                    $totalProduk2 += pow($p2 - $rata[$produk2], 2);
                }
            }
        }

        $hasil = sqrt($totalProduk1) * sqrt($totalProduk2);
        return $hasil;
    }

    public function main($member, $similarities, $fullProduk){
        // return $fullProduk;
        $hasil = [];
        foreach($fullProduk as $key => $fp){
            // $produkSorted[$key] = $fp;
            foreach($fp as $k => $fpx){
                $produkSorted[$k][$key] = $fpx;
            }
        }

        foreach($similarities as $np => $sim){
            foreach ($produkSorted[$member] as $key => $value) {
                if($np == $key){
                    continue 2;
                }
            }

            $atas = 0;
            $bawah = 0;

            foreach ($produkSorted[$member] as $key => $value) {
                if(isset($similarities[$np][$key])){
                    if($similarities[$np][$key] > 0){
                        $atas += $value * $similarities[$np][$key];
                    }
                }
            }
            
            foreach ($similarities[$np] as $sim) {
                if($sim > 0){
                    $bawah += $sim;
                }
            }

            if($bawah > 0 && $atas > 0){
                $hasil[$np]['hasil'] = $atas/$bawah;
            }
        }

        return $hasil;
    }
}
