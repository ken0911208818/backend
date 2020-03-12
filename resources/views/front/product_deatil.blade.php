@extends('layouts/nav')
@section('css')
<style>
    .card-product {
        padding: 10px 20px;
        width: 160px;
        min-height: 58px;
        height: 100%;
        font-size: 16px;
        line-height: 20px;
        color: #757575;
        text-align: center;
        border: 1px solid #eee;
        background-color: #fff;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        transition: opacity, border .2s linear;
    }

    .media-container-row .card-product.active {
        color: #424242;
        border-color: #ff6700;
        transition: opacity, border .2s linear;
    }
</style>
@endsection
@section('content')
<section class="engine"><a href="https://mobirise.info/x">css templates</a></section>
<section class="features3 cid-rRF3umTBWU" id="features3-7">




    <div class="container" style="margin-top:100px;">
        <div class="media-container-row">
            <div class="col-6">
                <img src="{{asset('/storage/'.$data->img)}}" alt="" srcset="" class="img-fluid">
            </div>
            <div class="col-6">

                <div class="product-title">
                    <div class="title">
                        <h2>{{$data->title}}</h2>
                    </div>
                    <div class="content pt-3">
                        <span id="capacity">3GB+32GB</span>
                        <span id="color">月影灰</span>
                    </div>
                    <div class="cost pt-3">
                        {{$data->price}}
                    </div>
                </div>
                <div class="product-tips pt-3">雙倍該商品可享受雙倍積分</div>
                <div class="product-capacity">
                    <div class="title pt-3">容量</div>
                    <div class="content row pt-3">
                        <div class="col-4">
                            <div class="card-product" data-capacity="3GB+32GB">3GB+32GB</div>
                        </div>
                        <div class="col-4">
                            <div class="card-product" data-capacity="4GB+64GB">4GB+64GB</div>
                        </div>
                    </div>

                </div>
                <div class="product-color  pt-3">
                    <div class="title">顏色</div>
                    <div class="content row pt-3">
                        <div class="col-4 pt-3">
                            <div class="card-product" data-color="紅">紅</div>
                        </div>
                        <div class="col-4 pt-3">
                            <div class="card-product" data-color="黃">黃</div>
                        </div>
                        <div class="col-4 pt-3">
                            <div class="card-product" data-color="藍">藍</div>
                        </div>
                        <div class="col-4 pt-3">
                            <div class="card-product" data-color="綠">綠</div>
                        </div>
                    </div>

                </div>
                <div class="product-qty pt-3">數量
                    <button class="min button">
                        -
                    </button>
                    <input type="text" name="qty" id="qty" maxlength="12" />
                    <button class="plus button">
                        +
                    </button>
                </div>
                <div class="product-total pt-3">
                    <div class="content">
                        <span>Redmi Note 8T</span>
                        <span id="color1">月影灰</span>
                        <span id="capacity1">3GB+32GB</span>
                        <span>*</span>
                        <span id="item">1</span>
                        <span>NT$4,599</span>
                    </div>
                    <div class="price">
                        <span>
                            總計：NT$4,599
                        </span>
                    </div>
                </div>
            <form action="/add_cart/{{$data->id}}" method="post">
                    @csrf
                    <input id="color3" type="text" name="color" value="" hidden>
                    <input id="capacity3" type="text" name="capacity" value="" hidden>
                    <input id="qty1" type="text" name="qty1" value="" hidden>
                    <button class="mt-3">立即購買</button>
                </form>


            </div>
        </div>


    </div>
</section>
@endsection


@section('js')

<script>
    $('.media-container-row .product-color .card-product').click(function(){
            $('.media-container-row .product-color .card-product').removeClass("active")
            this.setAttribute('class',' card-product active')
            color = $(this).attr('data-color')
            $('#color').text(color)
            $('#color1').text(color)
            $('#color3').val(color)

    })
    $('.media-container-row .product-capacity .card-product').click(function(){
            $('.media-container-row .product-capacity .card-product').removeClass("active")
            this.setAttribute('class',' card-product active')
            capacity = $(this).attr('data-capacity')
            $('#capacity').text(capacity)
            $('#capacity1').text(capacity)
            $('#capacity3').val(capacity)

    })

    $(function(){
    var j = jQuery; //Just a variable for using jQuery without conflicts
    var addInput = '#qty'; //This is the id of the input you are changing
    var n = 1; //n is equal to 1

    //Set default value to n (n = 1)
    j(addInput).val(n);

    //On click add 1 to n
    j('.plus').on('click', function(){
        var aa = ++n;
        j(addInput).val(aa);

        $('#item').text(aa);
        $('#qty1').val(aa);
    })

    j('.min').on('click', function(){
        //If n is bigger or equal to 1 subtract 1 from n
        if (n >= 1) {
        var aa = --n;
        j(addInput).val(aa);
        $('#item').text(aa);
        $('#qty1').val(aa);
        } else {
        //Otherwise do nothing
        }
    });
    });
</script>
@endsection
