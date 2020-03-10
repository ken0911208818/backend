@extends('layouts/app');

@section('content')




<div class="container">

    <form method="post" action="/home/product/{{$data->id}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        
        <div class="form-group">
            <label for="img">現在圖片</label>
            <img src="{{asset('storage/'.$data->img)}}" alt="" srcset="" class="img-fluid" width="200px">
        </div>
        <div class="form-group">
            <label for="img">重新上傳圖片</label>
            <input type="file" class="form-control" id="img" name="img" >
        </div>

        <label for="kinds">種類</label>
            <select name="kinds">

                    @foreach ($type as $item)
                        {{$item}}
                        @if ($data->kinds == $item->id)
                            <option selected="true" value="{{$item->id}}">{{$item->type}}</option>

                        @else
                            <option value="{{$item->id}}">{{$item->type}}</option>
                        @endif

                    @endforeach                　
            </select>
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$data->title}}">
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <input type="text" class="form-control" id="content" name="content" value="{{$data->content}}">
        </div>
        <div class="form-group">
            <label for="sort">sort</label>
            <input type="number" class="form-control" id="sort" name="sort" value="{{$data->sort}}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>


    </form>

</div>


@endsection
