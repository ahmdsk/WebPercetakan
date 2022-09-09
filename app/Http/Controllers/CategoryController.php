<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $data['web'] = [
            'title' => 'Kategori Produk',
            'breadcrumb' => [
                ['url' => '/category', 'name' => 'Kelola Produk'],
                ['url' => '/category', 'name' => 'Kategori Produk'],
            ],
        ];

        $data['category'] = Category::all();

        return view('admin.category.index', $data);
    }

    public function store(Request $request){
        $category = $request->validate([
            'category_name' => 'required',
        ]);

        $category['category_slug'] = Str::slug($category['category_name']);

        $addCategory = Category::insert($category);
        if($addCategory){
            return back()->with('success', 'Kategori Produk Berhasil Ditambah');
        }else{
            return back()->with('error', 'Kategori Produk Gagal Ditambah');
        }
    }

    public function edit($id){
        $category = Category::find($id);
        return response()->json([
            'status' => 200,
            'data'   => $category
        ]);
    }

    public function update(Request $request, $id){
        $category = $request->validate([
            'category_name' => 'required',
        ]);

        $updateCategory = Category::find($id)->update($category);
        if($updateCategory){
            return back()->with('success', 'Kategori Produk Berhasil Diupdate');
        }else{
            return back()->with('error', 'Kategori Produk Gagal Diupdate');
        }
    }

    public function destroy($id){
        $category = Category::destroy($id);
        if($category){
            return response()->json([
                "status" => 200
            ]);
        }
    }
}
