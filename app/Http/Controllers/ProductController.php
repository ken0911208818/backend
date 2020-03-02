<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('auth/product/index');
    }

    public function store(Request $request) {
        $data = $request->all();
        Product::create($data)->save();

        return redirect('/home/product');
    }
}
