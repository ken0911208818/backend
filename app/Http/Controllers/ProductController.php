<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return view('admin/product/index',compact('data'));
    }

    public function store(Request $request) {
        $data = $request->all();
        Product::create($data)->save();

        return redirect('/home/product');
    }

    public function create(){
        return view('admin.product.create');
    }

}
