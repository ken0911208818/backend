<?php

namespace App\Http\Controllers;

use App\News;
use App\Product;
use Darryldecode\Cart\Cart;
use DB;
use Illuminate\Http\Request;
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
    public function product_deatil($Product_id)
    {
        $data = Product::find($Product_id);
        return view('front.product_deatil',compact('data'));
    }
    public function add_cart(Request $request,$Product_id)
    {
        $cartData = $request->all();
        $sessionKey = Auth::id();
        $Product = Product::find($Product_id); // assuming you have a Product model with id, name, description & price
        $rowId = 456; // generate a unique() row ID
        $userID = 2; // the user ID to bind the cart contents

// add the product to cart
        \Cart::session($sessionKey)->add(array(
            'id' => $Product->id,
            'name' => $Product->title,
            'price' => $Product->price,
            'quantity' => $cartData['qty1'],
            'attributes' => array(),
            'associatedModel' => $Product,
        ));
        return view('front/index');
    }
    public function cart_total()
    {
        $sessionKey = Auth::id();
        $items = \Cart::session($sessionKey)->getContent();
        return view('front.cart_total',compact('items'));
    }
    public function delete_cart(Request $request)
    {

        $rowId =$request->rowId;
        $sessionKey = Auth::id();
        \Cart::session($sessionKey)->remove($rowId);

    }
}
