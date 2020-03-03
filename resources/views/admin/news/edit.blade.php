@extends('layouts/app');

@section('content')




<div class="container">
    @foreach ($data as $item)
<form method="post" action="/home/news/update/{{$item->id}}">
    @csrf

    <div class="form-group">
        <label for="img">IMG</label>
        <input type="text" class="form-control" id="img" name="img" value="{{$item->img}}">
        </div>
        <div class="form-group">
            <label for="title">title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{$item->title}}">
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
