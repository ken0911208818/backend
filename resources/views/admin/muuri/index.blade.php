@extends('layouts/app');

@section('css')
<style>
    .grid {
        position: relative;
    }

    .item {
        display: block;
        position: absolute;
        width: 100px;
        height: 100px;
        margin: 5px;
        z-index: 1;
        background: #000;
        color: #fff;
    }

    .item.muuri-item-dragging {
        z-index: 3;
    }

    .item.muuri-item-releasing {
        z-index: 2;
    }

    .item.muuri-item-hidden {
        z-index: 0;
    }

    .item-content {
        position: relative;
        width: 100%;
        height: 100%;
    }
</style>
@endsection


@section('content')
<div class="container">

    <div class="grid">

        <div class="item">
            <div class="item-content">
                <!-- Safe zone, enter your custom markup -->
                This can be anything.
                <!-- Safe zone ends -->
            </div>
        </div>

        <div class="item">
            <div class="item-content">
                <!-- Safe zone, enter your custom markup -->
                <div class="my-custom-content">
                    Yippee!
                </div>
                <!-- Safe zone ends -->
            </div>
        </div>

    </div>



@endsection


@section('js')
    <script src="https://unpkg.com/muuri@0.8.0/dist/muuri.min.js"></script>
    <script src="https://unpkg.com/web-animations-js@2.3.2/web-animations.min.js"></script>
    <script src="https://unpkg.com/muuri@0.8.0/dist/muuri.min.js"></script>
    <script>

        // dragEnabled 可移動嗎 預設false
        var grid = new Muuri('.grid', {
            dragEnabled: true
        });
    </script>
@endsection

