<?php

namespace App\Http\Controllers;
use App\News;

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
    {   $news = DB::table('news')->orderBy('sort','asc')->get();
        return view('front/news',compact('news'));
    }
    public function product()
    {
        $data = Product::orderBy('sort','desc')->get();
        return view('front/product',compact('data'));
    }
    public function newsimg($id)    {


        // $data = News::where('id',$id)->newsimg;
        // where 出來是陣列 需要使用first轉成物件
        $data = News::where('id',$id)->first()->newsimg;
        return view('front/newsimg',compact('data'));
    }
    public function test()
    {
        return view('layouts.app');
    }
    public function contentus()
    {

        return view('front/contentus');
    }
}
