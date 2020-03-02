<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('front/index');
    }
    public function news()
    {   $news = DB::table('news')->get();
        return view('front/news',compact('news'));
    }
    public function product()
    {
        $data = DB::table('product')->get();
        return view('front/product',compact('data'));
    }

}
