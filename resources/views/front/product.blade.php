@extends('layouts/nav')
@section('content')
<section class="mbr-gallery mbr-slider-carousel cid-rS3hYJJSXz mt-5" id="gallery2-3">



    <div class="container">
        <div><!-- Filter --><div class="mbr-gallery-filter container gallery-filter-active">
            <ul buttons="0">
                <li class="mbr-gallery-filter-all">
                    <a class="btn btn-md btn-primary-outline active display-7" href="">All</a>
                </li>
            </ul>
        </div><!-- Gallery -->
        <div class="mbr-gallery-row">
            <div class="mbr-gallery-layout-default">
                <div>
                    <div>
                        @foreach ($data as $item)
                    <div class="mbr-gallery-item mbr-gallery-item--p2" data-video-url="false" data-tags="{{$item->kinds}}">
                            <div href="#lb-gallery2-3" data-slide-to="{{$item->id - 1}}" data-toggle="modal">
                                <img src="{{$item->img}}" alt="" title="">
                                    <span class="icon-focus">
                                        </span>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
                    <div class="clearfix">
                    </div>
            </div>
        </div><!-- Lightbox -->
                        <div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1" data-keyboard="true" data-interval="false" id="lb-gallery2-3">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="assets/images/background1.jpg" alt="" title="">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="assets/images/background2.jpg" alt="" title="">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="assets/images/background3.jpg" alt="" title="">
                                            </div><div class="carousel-item">
                                                <img src="assets/images/background4.jpg" alt="" title="">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="assets/images/background5.jpg" alt="" title="">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="assets/images/background6.jpg" alt="" title=""></div>
                                                <div class="carousel-item"><img src="assets/images/background7.jpg" alt="" title="">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="assets/images/background8.jpg" alt="" title="">
                                                </div>
                                            </div>
                                            <a class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#lb-gallery2-3">
                                                <span class="mbri-left mbr-iconfont" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control carousel-control-next" role="button" data-slide="next" href="#lb-gallery2-3">
                                                <span class="mbri-right mbr-iconfont" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                            <a class="close" href="#" role="button" data-dismiss="modal">
                                                <span class="sr-only">Close</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </div>

</section>

@endsection
