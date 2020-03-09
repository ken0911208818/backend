@extends('layouts.nav')
@section('content')
<section class="services1 cid-rSHipPxh3m" id="services1-5">
    <!---->

    <!---->
    <!--Overlay-->

    <!--Container-->
    <div class="container">
        <div class="row justify-content-center" style="padding:100px;">
            <!--Titles-->
            <div class="title pb-5 col-12">
                <div class="mbr-section-btn align-left">
                    @foreach ($data as $item)
                    <a href="#"  onclick="kinds({{$item->type->id}})" class="btn btn-warning-outline display-4" >
                        {{$item->type->type}}
                    </a>
                    @endforeach
                </div>
            </div>
            <!--Card-1-->
            @foreach ($data as $item)
            <div class="card col-12 col-md-6 p-3 col-lg-4">
                <div class="card-wrapper">
                    <div class="card-img">
                        <img src="{{asset('/storage/'.$item->img)}}" alt="Mobirise">
                    </div>
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style display-5">
                            {{$item->title}}
                        </h4>
                        <p class="mbr-text mbr-fonts-style display-7">
                            {{$item->content}}
                        </p>
                        <!--Btn-->
                        <div class="mbr-section-btn align-left">
                            <a href="https://mobirise.co" class="btn btn-warning-outline display-4">
                                {{$item->type->type}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach



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
    });
    // $('#kinds').click(function(){
    //     // 將綁在按鈕上的data-newsimgid的值取出
    //     let kinds = (this.getAttribute('data-newsimgid'));
    //     console.log('aa');

    //     $.ajax({
    //         //   傳送路徑
    //           url: "",
    //         //   方法
    //           method: 'post',
    //         //   資料
    //           data: {
    //              newsimgid: imgid,
    //           },
    //         //   如果成功回傳
    //           success: function(result){
    //             //   將col-2綁上ID 指定的ID做remove(移除)
    //             $(`.col-2[data-newsimgid=${imgid}]`).remove();
    //           }
    //     });

    // })

    function kinds(kinds) {
        $('.card').remove()
        $('.card').show()
    }
</script>

@endsection
