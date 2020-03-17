<?php

namespace App\Http\Controllers;

use DB;
use App\News;
use App\Order;
use App\Order_detail;
use App\Product;
use Darryldecode\Cart\Cart;
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
    public function update_cart(Request $request ,$product_id)
    {
        $sessionKey = Auth::id();
        
        \Cart::session($sessionKey)->update($product_id, array(
            'quantity' => $request->qty, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
          ));
        return 'sussful';
    }
    public function cart_check()
    {
        // $data = Order::with('order_detail')->get();
        // dd($data);
        $sessionKey = Auth::id();
        $items = \Cart::session($sessionKey)->getContent();
        return view('front.cart_check',compact('items'));

    }
    public function post_cart_check(Request $request)
    {
        // $sessionKey = Auth::id();
        // $items = \Cart::session($sessionKey)->getContent();
        // dd($items);

        $Recipient_name = $request->Recipient_name;
        $Recipient_phone = $request->Recipient_phone;
        $Recipient_address = $request->Recipient_address;
        $shipment_time = $request->shipment_time;
        $order = new Order();
        $sessionKey = Auth::id();
        //主要訂單建立
        $order->user_id= $sessionKey;
        $order->Recipient_name = $Recipient_name;
        $order->Recipient_phone= $Recipient_phone;
        $order->Recipient_address = $Recipient_address;
        $order->shipment_time = $shipment_time;
        $order->totalPrice = \Cart::session($sessionKey)->getTotal();
        $order->save();
        //訂單詳細建立

        $items = \Cart::session($sessionKey)->getContent();
        foreach($items as $row) {
            $order_detial= new Order_detail();
            $order_detial->order_id = $order->id;
            $order_detial->product_id= $row->id;
            $order_detial->qty = $row->quantity;
            $order_detial->price =$row->price;
            $order_detial->save();
        }


    }
}
