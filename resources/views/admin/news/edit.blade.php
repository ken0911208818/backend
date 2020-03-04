@extends('layouts/app');

@section('content')




<div class="container">
    @foreach ($data as $item)
    <form method="post" action="/home/news/update/{{$item->id}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="img">現有圖片</label>
            <img src="{{$item->img}}" alt="" class="img-fluid" width="200px">
            <br>
            <label for="img">重新上傳圖片</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$item->title}}">
        </div>
        <div class="form-group">
            <label for="sort">title</label>
            <input type="number" class="form-control" id="sort" name="sort" value="{{$item->sort}}">
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{$item->content}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>


    </form>
    @endforeach
</div>


@endsection
