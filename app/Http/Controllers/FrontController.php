<?php

namespace App\Http\Controllers;

use DB;
use App\News;
use App\Order;
use App\Product;
use Carbon\Carbon;
use App\Order_detail;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use TsaiYiHua\ECPay\Checkout;
use Illuminate\Support\Facades\Auth;
use TsaiYiHua\ECPay\Services\StringService;
use TsaiYiHua\ECPay\Collections\CheckoutResponseCollection;

class FrontController extends Controller
{
    protected $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }
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
        $total = \Cart::session($sessionKey)->getTotal();
        if($total >1200){
            $ship_price = 0;
        }else
        {
            $ship_price = 120;
        }
        //主要訂單建立
        $order->order_no = 'ken'.Carbon::now()->format('Ymd').(rand(100, 200));
        $order->user_id= $sessionKey;
        $order->Recipient_name = $Recipient_name;
        $order->Recipient_phone= $Recipient_phone;
        $order->Recipient_address = $Recipient_address;
        $order->shipment_time = $shipment_time;
        $order->ship_price = $ship_price;
        $order->totalPrice = $total;
        $order->save();

        $order_ary=[];

        //訂單詳細建立
        //產品總數
        $items = \Cart::session($sessionKey)->getContent();
        foreach($items as $row) {
            $order_detial= new Order_detail();
            $order_detial->order_id = $order->id;
            $order_detial->product_id= $row->id;
            $order_detial->qty = $row->quantity;
            $order_detial->price =$row->price;
            $order_detial->save();

            $product = Product::find($row->id);
            $product_name = $product->title;

            $new_ary = [
                'name' => $product_name,
                'qty' => $row->quantity,
                'price' => $row->price,
                'unit' => '個'
            ];

            array_push($order_ary, $new_ary);

        }

        if($order->ship_price>0){
            $new_ary = [
                'name' => '運費',
                'qty' => 1,
                'price' => $order->ship_price,
                'unit' => '個'
            ];
        }else{
            $new_ary = [
                'name' => '運費',
                'qty' => 1,
                'price' => 0,
                'unit' => '個'
            ];
        }
        array_push($order_ary, $new_ary);
        //送出第三方支付
        $formData = [
            'UserId' => "", // 用戶ID , Optional
            'Items' => $order_ary,
            'ItemDescription' => '產品簡介',
            'OrderId' => $order->order_no,
            // 'ItemName' => 'Product Name',
            'TotalAmount' => $order->totalPrice,
            'PaymentMethod' => 'Credit', // ALL, Credit, ATM, WebATM
        ];
        //清空購物車
        //\Cart::session($sessionKey)->clear();
        return $this->checkout->setNotifyUrl(route('notify'))->setReturnUrl(route('return'))->setPostData($formData)->send();

    }
    public function notifyUrl(Request $request){
        $serverPost = $request->post();
        $checkMacValue = $request->post('CheckMacValue');
        unset($serverPost['CheckMacValue']);
        $checkCode = StringService::checkMacValueGenerator($serverPost);
        if ($checkMacValue == $checkCode) {
            return '1|OK';
        } else {
            return '0|FAIL';
        }
    }

    public function returnUrl(Request $request){
        $serverPost = $request->post();
        $checkMacValue = $request->post('CheckMacValue');
        unset($serverPost['CheckMacValue']);
        $checkCode = StringService::checkMacValueGenerator($serverPost);
        if ($checkMacValue == $checkCode) {
            if (!empty($request->input('redirect'))) {
                return redirect($request->input('redirect'));
            } else {

                //付款完成，下面接下來要將購物車訂單狀態改為已付款
                //目前是顯示所有資料將其DD出來
                //dd($this->checkoutResponse->collectResponse($serverPost));
                
                $new_order = Order::where('order_no',$serverPost['MerchantTradeNo'])->first();
                $new_order ->ship_status = "已結帳";
                $new_order->save();
                return '付款完成';
            }
        }
    }
    public function text_cart_check()
    {
        $formData = [
            'UserId' => 1, // 用戶ID , Optional
            'ItemDescription' => '產品簡介',
            'ItemName' => 'Product Name',
            'TotalAmount' => '2000',
            'PaymentMethod' => 'Credit', // ALL, Credit, ATM, WebATM
        ];
        return $this->checkout->setPostData($formData)->send();
    }
}
