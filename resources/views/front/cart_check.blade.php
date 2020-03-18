@extends('layouts/nav')
@section('css')
<style>
    .Cart {

        margin: 50px auto;
    }

    .Cart__header {
        display: grid;
        grid-template-columns: 3fr 1fr 1fr 1fr ;
        grid-gap: 2px;
        margin-bottom: 2px;
    }

    .Cart__headerGrid {
        text-align: center;
        background: #f3f3f3;
    }

    .Cart__product {
        display: grid;
        grid-template-columns: 2fr 7fr 3fr 3fr 3fr ;
        grid-gap: 2px;
        margin-bottom: 2px;

    }

    .Cart__productGrid {
        padding: 5px;
    }

    .Cart__productImg {
        background-image: url(https://fakeimg.pl/640x480/c0cfe8/?text=Img);
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .Cart__productTitle {
        overflow: hidden;
        line-height: 25px;
    }

    .Cart__productPrice,
    .Cart__productQuantity,
    .Cart__productTotal,
    .Cart__productDel {
        text-align: center;
        align-items: center;
    }

    @media screen and (max-width: 820px) {
        .Cart__header {
            display: none;
        }

        .Cart__product {
            box-shadow: 2px 2px 3px 0 rgba(0, 0, 0, 0.5);
            margin-bottom: 10px;
            grid-template-rows: 1fr 1fr;
            grid-template-columns: 2fr 2fr 2fr 2fr 2fr 2fr 1fr;
            grid-template-areas:
                "img title title title title title del"
                "img price price quantity total total del";
        }

        .Cart__productImg {
            grid-area: img;
        }

        .Cart__productTitle {
            grid-area: title;
        }

        .Cart__productPrice,
        .Cart__productQuantity,
        .Cart__productTotal,
        .Cart__productDel {
            line-height: initial;
        }

        .Cart__productPrice {
            grid-area: price;
            text-align: right;
        }

        .Cart__productQuantity {
            grid-area: quantity;
            text-align: left;
        }

        .Cart__productQuantity::before {
            content: "x";
        }

        .Cart__productTotal {
            grid-area: total;
            text-align: right;
            color: red;
        }

        .Cart__productDel {
            grid-area: del;
            line-height: 60px;
            background: #ffc0cb26;
        }
    }
</style>
@endsection
@section('content')
<example-component cart-item="{{$items}}"></example-component>
<section class="engine"><a href="https://mobirise.info/x">css templates</a></section>
<section class="features3 cid-rRF3umTBWU" id="features3-7">
    <div class="container" style="margin-top:100px;">
        <div class="Cart">
            <div class="Cart__header">
                <div class="Cart__headerGrid">商品</div>
                <div class="Cart__headerGrid">單價</div>
                <div class="Cart__headerGrid">數量</div>
                <div class="Cart__headerGrid">小計</div>

            </div>
            @foreach ($items as $item)

            <div class="Cart__product" data-cartid="{{$item->id}}">
                <div class="Cart__productGrid Cart__productImg">
                    <img class="img-fluid" src="{{asset('/storage/'.$item->associatedModel->img)}}" alt="" srcset="">
                </div>
                <div class="Cart__productGrid Cart__productTitle">
                    {{$item->name}}
                </div>
                <div class="Cart__productGrid Cart__productPrice d-flex justify-content-center">${{$item->price}}</div>
                <div
                    class="Cart__productGrid Cart__productQuantity d-flex justify-content-center alitem-content-center">

                    <span class="">{{$item->quantity}}</span>

                </div>
                <div class="Cart__productGrid Cart__productTotal d-flex justify-content-center">
                    {{$item->price * $item->quantity}}</div>
            </div>
            @endforeach
            <?php
            $sessionKey = Auth::id();
            $items = \Cart::session($sessionKey)->getTotal();
            if($items > 1200){

                $ship_price = 120;
            }
            else{
                $ship_price = 0;
            }
            ?>
            <div class="text-right">
                <p>運費:{{$ship_price}}</p>
            <p>總計{{$items + $ship_price}}</p>
            </div>

            <form action="/cart_check" method="POST" class="mbr-form form-with-styler" data-form-title="Mobirise Form"><input type="hidden" name="email" data-form-email="true" value="QRKoMAD9d5BXOvdqcV9DL0fiSM9bKmXsebt5JCXNFQLM3AZlcIzqFy7HmsSDz+jabviuiTOn7SdNdS0S9yIGSVKWGO4fiDlwLI35rOk6lf8KIxs4qLxILClhToqs2nLo">
                @csrf
                <div class="row">
                    <div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Thanks for filling out the form!</div>
                    <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                    </div>
                </div>
                <div class="dragArea ">
                    <div class="col-md-4  form-group" data-for="Recipient_name">
                        <label for="Recipient_name" class="form-control-label mbr-fonts-style display-7">name</label>
                        <input type="text" name="Recipient_name" data-form-field="Name" required="required" class="form-control display-7" id="Recipient_name">
                    </div>
                    <div class="col-md-4  form-group" data-for="email">
                        <label for="Recipient_phone" class="form-control-label mbr-fonts-style display-7">phone</label>
                        <input type="text" name="Recipient_phone" data-form-field="Email" required="required" class="form-control display-7" id="Recipient_phone">
                    </div>
                    <div data-for="phone" class="col-md-4  form-group">
                        <label for="Recipient_address" class="form-control-label mbr-fonts-style display-7">Address</label>
                        <input type="tel" name="Recipient_address" data-form-field="Phone" class="form-control display-7" id="Recipient_address">
                    </div>
                    <div data-for="message" class="col-md-4 form-group">
                        <label for="shipment_time" class="form-control-label mbr-fonts-style display-7">shipment_time</label>
                        <input type="text" name="shipment_time" data-form-field="Message" class="form-control display-7" id="shipment_time">
                    </div>
                    <div class="col-md-12 input-group-btn align-center">
                        <button type="submit" class="btn btn-primary btn-form display-4">前往結帳</button>
                    </div>
                </div>
            </form><!---Formbuilder Form--->

        </div>

    </div>

</section>
@endsection


@section('js')

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });// 當col-2 .btn-danger 的按鈕 被按下時 執行一個匿名函式

    $('.Cart__productDel .btn-danger').click(function(){

        // 將綁在按鈕上的data-newsimgid的值取出
        let cartId = (this.getAttribute('data-cartid'));


        $.ajax({
            //   傳送路徑
              url: "{{ url('/delete_cart') }}",
            //   方法
              method: 'post',
            //   資料
              data: {
                 rowId:cartId,
              },
            //   如果成功回傳
              success: function(result){
                //   將col-2綁上ID 指定的ID做remove(移除)
                $(`.Cart__product[data-cartid=${cartId}]`).remove();

              }
        });

    })


    //加減數量
    $('.Cart__productGrid .btn btn-primary').click(function(){
        console.log('aa');

    // 將綁在按鈕上的data-newsimgid的值取出
    let cartId = (this.getAttribute('data-cartid'));
    console.log(cartId);
    // $.ajax({
    //     //   傳送路徑
    //     url: "{{ url('/delete_cart') }}",
    //     //   方法
    //     method: 'post',
    //     //   資料
    //     data: {
    //         rowId:cartId,
    //     },
    //     //   如果成功回傳
    //     success: function(result){
    //         //   將col-2綁上ID 指定的ID做remove(移除)
    //         $(`.Cart__product[data-cartid=${cartId}]`).remove();

    //     }
    // });

    })
</script>
@endsection
