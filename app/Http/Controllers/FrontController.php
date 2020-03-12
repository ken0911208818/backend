<?php

namespace App\Http\Controllers;

use App\News;
use App\Product;
use Darryldecode\Cart\Cart;
use DB;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        return view('front/index');
    }
    public function news()
    {$news = DB::table('news')->orderBy('sort', 'asc')->get();
        return view('front/news', compact('news'));
    }
    public function product()
    {
        $data = Product::orderBy('sort', 'desc')->get();
        return view('front/product', compact('data'));
    }
    public function newsimg($id)
    {

        // $data = News::where('id',$id)->newsimg;
        // where 出來是陣列 需要使用first轉成物件
        $data = News::where('id', $id)->first()->newsimg;
        return view('front/newsimg', compact('data'));
    }
    public function test()
    {
        return view('layouts.app');
    }
    public function contentus()
    {

        return view('front/contentus');
    }
    public function product_deatil()
    {
        return view('front.product_deatil');
    }
    public function add_cart()
    {
        $sessionKey = Auth::id();
        $Product = Product::find(1); // assuming you have a Product model with id, name, description & price
        $rowId = 456; // generate a unique() row ID
        $userID = 2; // the user ID to bind the cart contents

// add the product to cart
        \Cart::session($sessionKey)->add(array(
            'id' => $rowId,
            'name' => $Product->title,
            'price' => $Product->price,
            'quantity' => 4,
            'attributes' => array(),
            'associatedModel' => $Product,
        ));
    }
    public function cart_total()
    {
        $sessionKey = Auth::id();
        $items = \Cart::session($sessionKey)->getContent();
        dd($items);
    }
}
