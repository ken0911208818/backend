@extends('layouts/nav')
@section('css')
<style>
    .Cart {

        margin: 50px auto;
    }

    .Cart__header {
        display: grid;
        grid-template-columns: 3fr 1fr 1fr 1fr 1fr;
        grid-gap: 2px;
        margin-bottom: 2px;
    }

    .Cart__headerGrid {
        text-align: center;
        background: #f3f3f3;
    }

    .Cart__product {
        display: grid;
        grid-template-columns: 2fr 7fr 3fr 3fr 3fr 3fr;
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

<section class="engine"><a href="https://mobirise.info/x">css templates</a></section>
<section class="features3 cid-rRF3umTBWU" id="features3-7">
    <example-component cart-item="{{$items}}"></example-component>
    {{-- <div class="container" style="margin-top:100px;">
        <div class="Cart">
            <div class="Cart__header">
                <div class="Cart__headerGrid">商品</div>
                <div class="Cart__headerGrid">單價</div>
                <div class="Cart__headerGrid">數量</div>
                <div class="Cart__headerGrid">小計</div>
                <div class="Cart__headerGrid">刪除</div>
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
                    <button class="btn1 btn btn-primary" style="padding: 5px" data-cartid="{{$item->id}}">-</button>
                    <span class="">{{$item->quantity}}</span>
                    <button class="btn2 btn btn-primary" style="padding: 5px" data-cartid="{{$item->id}}">+</button>
                </div>
                <div class="Cart__productGrid Cart__productTotal d-flex justify-content-center">
                    {{$item->price * $item->quantity}}</div>
                <div class="Cart__productGrid Cart__productDel d-flex justify-content-center">
                    <button class="btn btn-danger" style="padding: 5px" type="button"
                        data-cartid="{{$item->id}}">X</button>
                </div>
            </div>
            @endforeach


        </div>
        <a href="/cart_check" class="btn btn-sm btn-primary " style="width: 120px">前往結帳</a>
    </div> --}}

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
    $('.Cart__productGrid .btn1').click(function(){


    // 將綁在按鈕上的data-newsimgid的值取出
    let cartId = (this.getAttribute('data-cartid'));

    $.ajax({
        //   傳送路徑
        url: "/update_cart/"+cartId,
        //   方法
        method: 'post',
        //   資料
        data: {
            qty:-1,
        },
        //   如果成功回傳
        success: function(result){
            console.log(result);

        }
    });

    })
    $('.Cart__productGrid .btn2').click(function(){


// 將綁在按鈕上的data-newsimgid的值取出
let cartId = (this.getAttribute('data-cartid'));

$.ajax({
    //   傳送路徑
    url: "/update_cart/"+cartId,
    //   方法
    method: 'post',
    //   資料
    data: {
        qty:1,
    },
    //   如果成功回傳
    success: function(result){
        console.log(result);

    }
});

})
</script>
@endsection
