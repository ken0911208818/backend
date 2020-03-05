@extends('layouts/nav')
@section('content')
<section class="engine"><a href="https://mobirise.info/x">css templates</a></section><section class="features3 cid-rRF3umTBWU" id="features3-7">




    <div class="container" style="margin-top:100px;">



        @foreach ($data as $item)
            <img width="100px" src="{{$item->img_url}}" alt="" srcset="">
        @endforeach

    </div>
</section>
@endsection
