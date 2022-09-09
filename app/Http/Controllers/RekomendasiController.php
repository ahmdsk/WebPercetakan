<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RekomendasiController extends Controller
{
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

        array_multisort($ranks, SORT_DESC);
        return $ranks;
    }



    public function rekomendasi()
    {
        // semua userr
        $users = DB::table('users')->where('role', 'user')->get();

        // user yang telah login
        $userLogin = Auth::user();
        
        // cek pesanan user yang telah login
        $cekPesananUserLogin = Pemesanan::where('user_id', $userLogin->id)->get();


        $dataRekomendasi = [];
        if(count($cekPesananUserLogin) > 0){
            foreach($users as $u){
                $pesanan = Pemesanan::where('user_id', $u->id)->with('products')->get();
                foreach($pesanan as $psn){
                    $rating = DB::table('product_ratings')
                            ->where('id_product', $psn->products->id)
                            ->where('id_user', $u->id)
                            ->select('ratings')->pluck('ratings')->first();
    
                    $dataRekomendasi[$u->id][$psn->products->product_name] = $rating;
                }
            }
        }

        // print_r($dataRekomendasi);
        // return $dataRekomendasi;
        $rekomendasi = $this->getRecommendations($dataRekomendasi, Auth::user()->id);
        return $rekomendasi;
    }
}
